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
        $projects = $this->getDoctrine()
                         ->getRepository('Market3wSiteBundle:Project');
        
        return array('projects' => $projects);
    }
    
    /**
     * @Route("/realisation/{name}")
     * @Template()
     */
    public function detailAction($name)
    {
        $project = $this->getDoctrine()
                        ->getRepository('Market3wSiteBundle:Project')
                        ->findOneByName($name);
        
        return array('project' => $project);
    }
}
