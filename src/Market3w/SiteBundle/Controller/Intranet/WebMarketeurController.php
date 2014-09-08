<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Market3w\SiteBundle\Form\Type\Intranet\ClientInfoType;
use Market3w\SiteBundle\Form\Type\Intranet\ClientType;
use Market3w\SiteBundle\Entity\User;
use Market3w\SiteBundle\Entity\Company;
use Market3w\SiteBundle\Entity\Address;


/**
 * WebMarketeur  controller.
 *
 * @Route("/intranet/client")
 */
class WebMarketeurController extends Controller 
{
    /**
     * My clients.
     *
     * @Route("/", name="clients_index")
     * @Template()
     */
    public function indexAction($id=null)
    {  
        if ($this->container->get('request')->get('_route') == 'api_get_clients' ){
            $em = $this->getDoctrine()->getManager();
            $clients = $em->getRepository("Market3wSiteBundle:User")->getClientsForWM($id);
            
            return new Response(json_encode($clients));
        }
        else {
            $wm = $this->getUser();
            $clients = $wm->getClients();
            
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $clients,
                $this->get('request')->query->get('page', 1)/*page number*/,
                10/*limit per page*/
            );
            return array('clients' => $pagination);
        }   
    }
    
    /**
     * Detail appointment
     *
     * @Route("/{id}", name="client_show", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        if ($this->container->get('request')->get('_route') == 'api_get_client' ){
            $client = $em->getRepository('Market3wSiteBundle:User')->getDetail($id);
            return new Response(json_encode($client));
        }
        else {
            $client    = $em->getRepository('Market3wSiteBundle:User')->find($id);
            $bills     = $em->getRepository("Market3wSiteBundle:Bill")->findBillForClient($client->getId());
            $estimates = $em->getRepository("Market3wSiteBundle:Bill")->findEstimateForClient($client->getId());

            $paginator  = $this->get('knp_paginator');
            $paginationBills = $paginator->paginate(
                $bills,
                $this->get('request')->query->get('page', 1)/*page number*/,
                3/*limit per page*/
            );

            $paginationEstimates = $paginator->paginate(
                $estimates,
                $this->get('request')->query->get('page', 1)/*page number*/,
                3/*limit per page*/
            );

            return array('client' => $client, 'bills' => $paginationBills, 'estimates' => $paginationEstimates);
        } 
    }
    
    /**
     * Edit client
     *
     * @Route("/{id}/edit", name="web_marketeur_edit_client", requirements={"id" = "\d+"})
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $wm = $this->getUser();
        
        $em     = $this->getDoctrine()->getManager();
        $client = $em->getRepository('Market3wSiteBundle:User')->find($id);

        $form = $this->createForm(new ClientInfoType(), $client);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em->persist($client);
            $em->flush();
            
            return $this->redirect($this->generateUrl( 'client_show', array('id' => $client->getId() )));
        }
        
        return array('form' => $form->createView());
    }
    
     /**
     * Billing client
     *
     * @Route("/{id}/billing", name="web_marketeur_billing_client", requirements={"id" = "\d+"})
     * @Template()
     */
    public function billingAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $client    = $em->getRepository('Market3wSiteBundle:User')->find($id);
        $bills     = $em->getRepository("Market3wSiteBundle:Bill")->findBillForClient($client->getId());
        $estimates = $em->getRepository("Market3wSiteBundle:Bill")->findEstimateForClient($client->getId());
        
        return array( 
            'client'    => $client,            
            'bills'     => $bills, 
            'estimates' => $estimates 
        );    
    }

    /**
    * Add client
     *
     * @Route("/add", name="web_marketeur_add_client")
     * @Template()
     */
    public function addClientAction(Request $request)
    {
        $client = new User();
        $form   = $this->createForm(new ClientType(), $client);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $password = uniqid();
            
            $client->setUsername($client->getEmail());
            $client->setPassword($password);
            $client->setEnabled(true);
            $client->setWebMarketeur($this->getUser());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            
            if( $form->get('type')->getData('') == 'ROLE_CLIENT' ){
                $fosUserManipulator = $this->container->get('fos_user.util.user_manipulator');
                $fosUserManipulator->removeRole($client->getUsername(), 'ROLE_PROSPECT');
                $fosUserManipulator->addRole($client->getUsername(), 'ROLE_CLIENT');
            }
            
            $em->flush();
            
            return $this->redirect($this->generateUrl( 'client_show', array('id' => $client->getId() )));

        }
        
        
        return array('form' => $form->createView());    
    }
    
    /**
     * API Edit appointment
     */
    public function postClientAction(Request $request)
    {                
        $em = $this->getDoctrine()->getManager();
        $wm = $em->getRepository('Market3wSiteBundle:User')->find($request->get('id'));
        
        // Create Address
        $address = new Address();
        $address->setFirstLine($request->get('firstLine'));
        
        if( !empty(trim($request->get('secondLine'))) ) {
            $address->setSecondLine($request->get('secondLine'));
        }
        
        if( !empty(trim($request->get('thirdLine'))) ) {
            $address->setThirdLine($request->get('thirdLine'));
        }
                
        $address->setZipcode($request->get('zipcode'));
        $address->setCity($request->get('city'));
        $address->setCountry($request->get('country'));
        
        // Create company and link address
        $company = new Company();
        $company->setName($request->get('company'));
        $company->setSiret($request->get('siret'));
        $company->setAddress($address);    
        
        // Create client or prospect and link company
        $client = new User();
        $client->setEmail($request->get('email'));
        $client->setUsername($client->getEmail());
        $client->setPassword(uniqid());
        $client->setEnabled(true);
        $client->setWebMarketeur($wm);
        $client->setFirstName($request->get('firstName'));
        $client->setLastName($request->get('lastName'));
        $client->setPhoneNumber($request->get('phoneNumber'));
        $client->setMobilePhoneNumber($request->get('mobilePhoneNumber'));
        $client->setCompany($company);
        
        $em->persist($client);
        $em->flush();
        
        if ($request->get('type') == 2){
            $fosUserManipulator = $this->container->get('fos_user.util.user_manipulator');
            $fosUserManipulator->removeRole($client->getUsername(), 'ROLE_PROSPECT');
            $fosUserManipulator->addRole($client->getUsername(), 'ROLE_CLIENT');
        }
        
        $em->flush();
        
        return new Response();
    }
    
}
