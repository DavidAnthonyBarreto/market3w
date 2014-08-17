<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Route("/", name="client_show_statistics")
     * @Template()
     */
    public function indexAction($id)
    {
        $em      = $this->getDoctrine()->getManager();
        $client  = $em->getRepository('Market3wSiteBundle:User')->find($id); 
        
        $history = $client->getSeoStatistics();
        $dates = array();
        foreach($history as $stats){
            $seoStatistics = $stats->getSeoStatistic();
            $date = $seoStatistics->getCreatedAt()->format('d/m/Y');
            $sdate = $seoStatistics->getCreatedAt()->format('Y-m-d');
            $dates[$sdate] = $date;
        }
        return array('clientId' => $id, 'dates' => $dates);
    }
    
    /**
     * Add statistics
     *
     * @Route("/add", name="client_add_statistics", requirements={"id" = "\d+"})
     * @Template()
     */
    public function addAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('Market3wSiteBundle:User')->find($id); 
                
        $seoStatistics = new SeoStatistics();        
        $form = $this->createForm(new SeoStatisticsType(), $seoStatistics);

        $form->handleRequest($request);
        
        if ($form->isValid()) {       
            $str = $seoStatistics->getCreatedAt()->format('Y-m-d');
            $seoStatistics->setUpdatedAt($seoStatistics->getCreatedAt());
            $repo = $em->getRepository('Market3wSiteBundle:History');
            $query = $em->createQuery(
                "SELECT h
                FROM Market3wSiteBundle:History h
                WHERE h.client = $id
                AND h.date LIKE '%$str%'"
            );

            $dateExists = $query->getResult();
            if(!$dateExists){
                $history = new History();
                $history->setSeoStatistic($seoStatistics);
                $history->setClient($client);
                $history->setDate($seoStatistics->getCreatedAt());

                $em->persist($seoStatistics);
                $em->persist($history);
                $em->flush();

                return $this->redirect($this->generateUrl('client_show_statistics', array('id' => $id)));
            }
            else{
                $form->get('createdAt')->addError(new FormError('Une statistique à déjà été ajouté pour cette date, pour l\'éditer rendez vous sur la page "modifier une statistique"'));
            }
        }
        
        
        return array('form' => $form->createView(), 'id' => $id);
    }
    
    /**
     * Edit statistics
     *
     * @Route("/{date}/edit", name="client_edit_statistics", requirements={"id" = "\d+"})
     * @Template()
     */
    public function editAction($id, $date, Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('Market3wSiteBundle:History');
        $query = $em->createQuery(
            "SELECT h
            FROM Market3wSiteBundle:History h
            WHERE h.client = $id
            AND h.date LIKE '%$date%'"
        );
        $seoExists = $query->getResult();
        
        if(!$seoExists){
            var_dump('erreur history not found');die;
        }
        $seoStatistics = $em->getRepository('Market3wSiteBundle:SeoStatistics')->find($seoExists[0]->getSeoStatistic());
        $client = $em->getRepository('Market3wSiteBundle:User')->find($seoExists[0]->getClient());
        $form = $this->createForm(new SeoStatisticsType(), $seoStatistics);
        $form->handleRequest($request);

        if ($form->isValid()) {     
            $now = new \DateTime();
            $seoStatistics->setUpdatedAt($now);
            
            $em->persist($seoStatistics);
            $em->flush();

            return $this->redirect($this->generateUrl('client_show_statistics', array('id' => $id)));
        }
        return array('form' => $form->createView(),'id' => $id);
    }
    
    /**
     * Get statistics JSON
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
    
    /**
     * Get statistics dates JSON
     *
     * @Route("/dates/get", name="client_get_statistics_dates", requirements={"id" = "\d+"})
     * @Template()
     */
    public function getDateAction($id)
    {
        $em      = $this->getDoctrine()->getManager();
        $client  = $em->getRepository('Market3wSiteBundle:User')->find($id); 
        
        $history = $client->getSeoStatistics();
        $dates = array();
        foreach($history as $stats){
            $seoStatistics = $stats->getSeoStatistic();
            $date = $seoStatistics->getCreatedAt()->format('d/m/Y');
            $dates[] = $date;
        }
        
        $response = new Response(json_encode($dates));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
}
