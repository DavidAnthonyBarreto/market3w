<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Market3w\SiteBundle\Form\Type\Intranet\ClientInfoType;
use Market3w\SiteBundle\Form\Type\Intranet\ClientType;
use Market3w\SiteBundle\Entity\User;


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
    public function indexAction()
    {
        $wm = $this->getUser();
        
        $em      = $this->getDoctrine()->getManager();
        $clients = $wm->getClients();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $clients,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return array('clients' => $pagination);
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
        $em       = $this->getDoctrine()->getManager();
        
        $client    = $em->getRepository('Market3wSiteBundle:User')->find($id);
        $bills     = $em->getRepository("Market3wSiteBundle:Bill")->findBillForClient($client->getId());
        $estimates = $em->getRepository("Market3wSiteBundle:Bill")->findEstimateForClient($client->getId());
                       
        return array('client' => $client, 'bills' => $bills, 'estimates' => $estimates);
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
     * Billing client
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
        
}
