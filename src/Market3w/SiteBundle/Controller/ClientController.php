<?php

namespace Market3w\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ClientController extends Controller
{
    /**
     * @Route("/profile/billing")
     * @Template()
     */
    public function billingAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $client    = $this->container->get('security.context')->getToken()->getUser();
        $bills     = $em->getRepository("Market3wSiteBundle:Bill")->findBillForClient($client->getId());
        $estimates = $em->getRepository("Market3wSiteBundle:Bill")->findEstimateForClient($client->getId());
        
        return array( 
            'bills'     => $bills, 
            'estimates' => $estimates 
        );    
    }
    
    /**
     * @Route("/profile/billing/{id}", name="client_billing_show", requirements={"id" = "\d+"})
     * @Template()
     */
    public function billingShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $bill = $em->getRepository("Market3wSiteBundle:Bill")->find($id);
        
        return array("bill" => $bill);
    }
    
    /**
     * @Route("/profile/seo")
     * @Template()
     */
    public function seoAction()
    {
        $client = $this->container->get('security.context')->getToken()->getUser();
                       
        return array( 'client' => $client );    
    }

}
