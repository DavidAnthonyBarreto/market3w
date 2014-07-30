<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


/**
 * Agenda  controller.
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
        $wm       = $this->getUser();
        $em       = $this->getDoctrine()->getManager();
        
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
         $client   = $em->getRepository('Market3wSiteBundle:User')->find($id);
               
        return array('client' => $client);
    }
}
