<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Market3w\SiteBundle\Controller\Intranet\DateTime;

use Market3w\SiteBundle\Entity\History;
use Market3w\SiteBundle\Entity\SeoStatistics;
use Market3w\SiteBundle\Form\Type\Intranet\SeoStatisticsType;

/**
 * Agenda  controller.
 *
 * @Route("/intranet/client/{id}/statistics")
 */
class StatisticsController extends Controller 
{
    /**
     * My clients.
     *
     * @Route("/", name="client_show_statitics")
     * @Template()
     */
    public function indexAction($id)
    {
        $wm       = $this->getUser();
        $em       = $this->getDoctrine()->getManager();
        
        $em->flush();
        
        
        $clients = $wm->getClients();
        
        return array('clients' => $clients);
    }
    
    /**
     * Edit appointment
     *
     * @Route("/edit", name="client_edit_statistics", requirements={"id" = "\d+"})
     * @Template()
     */
    public function addStatisticsAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('Market3wSiteBundle:User')->find($id); 
                
        $seoStatistics = new SeoStatistics();        
        $form = $this->createForm(new SeoStatisticsType(), $seoStatistics);

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $date = new \DateTime();
            
            $seoStatistics->setCreatedAt($date);
            $seoStatistics->setUpdatedAt($date);
            
            $history = new History();
            $history->setSeoStatistic($seoStatistics);
            $history->setClient($client);
            $history->setDate($date);
            
            
            $em->persist($seoStatistics);
            $em->persist($history);
            $em->flush();
            
            return $this->redirect($this->generateUrl('client_show', array('id' => $id)));
        }
        
        
        return array('form' => $form->createView());
    }
    
    /**
     * Show statistics
     *
     * @Route("/get", name="client_get_statistics", requirements={"id" = "\d+"})
     * @Template()
     */
    public function showAction($id)
    {
        $em      = $this->getDoctrine()->getManager();
        $client  = $em->getRepository('Market3wSiteBundle:User')->find($id); 
        
        
        $history = $client->getSeoStatistics();
        $statistics = array();
        foreach($history as $stats){
            $seoStatistics = $stats->getSeoStatistic();
            $date = $seoStatistics->getCreatedAt()->format('d/m/Y');
            $statistics['charts']['uniqueVisitors'][]      = $seoStatistics->getUniqueVisitors();
            $statistics['charts']['rank'][]                = $seoStatistics->getRank();
            $statistics['charts']['nbViewedPages'][]       = $seoStatistics->getNbViewedPages();
            $statistics['charts']['reboundTime'][]         = $seoStatistics->getReboundTime();
            $statistics['strings']['keywords'][$date]      = $seoStatistics->getKeywords();
            $statistics['strings']['topViewedPage'][$date] = $seoStatistics->getTopViewed();
            $statistics['date'][]                          = $date;
        }                
        
        
        $response = new Response(json_encode($statistics));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
}
