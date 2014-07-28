<?php

namespace Market3w\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class OurWorkController extends Controller
{
    /**
     * @Route("/realisations")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
       
        $projects = $em->getRepository('Market3wSiteBundle:Project')->findAll();
        
        return array('projects' => $projects);
    }
    
}
