<?php

namespace Market3w\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContactController extends Controller 
{
    /**
     * @Route("/contact")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
