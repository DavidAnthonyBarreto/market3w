<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Agendra  controller.
 *
 * @Route("/intranet/agenda")
 */
class AgendaController 
{
     /**
     * My agenda.
     *
     * @Route("/", name="agenda_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        
    }
}
