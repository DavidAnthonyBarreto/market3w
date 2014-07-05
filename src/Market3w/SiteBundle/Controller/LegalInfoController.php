<?php

namespace Market3w\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class LegalInfoController extends Controller 
{
    /**
     * @Route("/cgu")
     * @Template()
     */
    public function cguAction()
    {        
        return array();
    }
    
    /**
     * @Route("/mentionslegales")
     * @Template()
     */
    public function legalNoticeAction()
    {
        return array();
    }
}
