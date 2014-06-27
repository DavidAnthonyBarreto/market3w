<?php

namespace Market3w\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UsController extends Controller 
{
    /**
     * @Route("/societe")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
