<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Market3w\SiteBundle\Form\Type\Intranet\ClientInfoType;

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
        
        return array('clients' => $clients);
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
        }
        
        return array('form' => $form->createView());
    }
}
