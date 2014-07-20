<?php

namespace Market3w\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Market3w\SiteBundle\Entity\Project;

class HomepageController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()
                         ->getRepository('Market3wSiteBundle:Project')
                         ->findRandomProjects(4);
        
        return array('projects' => $projects);
    }
}
