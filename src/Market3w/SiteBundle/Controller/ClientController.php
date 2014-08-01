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
        $client = $this->container->get('security.context')->getToken()->getUser();
        
        $bills = $client->getBills();
        
        return array( 'bills' => $bills );    
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
