<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Market3w\SiteBundle\Controller\Intranet\DateTime;

use Market3w\SiteBundle\Entity\News;
use Market3w\SiteBundle\Form\Type\Intranet\NewsType;


class NewsController extends Controller 
{
    /**
     * My clients.
     *
     * @Route("/intranet/news", name="intranet_news_index")
     * @Route("/rss", name="news_rss_index")
     * @Template()
     */
    public function indexAction()
    {
        $wm      = $this->getUser();
        $em      = $this->getDoctrine()->getManager();
        
        $news    = $em->getRepository('Market3wSiteBundle:News')->findAll();
        
        $request = $this->container->get('request');
        $routeName = $request->get("_route");
        if($routeName=="news_rss_index"){
           $content = $this->renderView("Market3wSiteBundle:Intranet/News:rssAllNews.xml.twig", array('news'=>$news));
           return new Response($content);
        }
        
        return array('news' => $news);
        
        
    }
    
    /**
     * Add News
     *
     * @Route("/intranet/news/add", name="intranet_news_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cm = $this->getUser(); 
       
        $author = $cm->getFirstName().' '.$cm->getLastName();
           
        $news = new News();  
        $news->setAuthor($author);
        $news->setPubDate(new \DateTime());
        $form = $this->createForm(new NewsType(), $news);

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            
            $news->setGuid($news->getTitle());
            
            $em->persist($news);
            $em->flush();
            
            return $this->redirect($this->generateUrl('intranet_news_index'));
        }
        
        
        return array('form' => $form->createView());
    }
    
    /**
     * Show statistics
     *
     * @Route("/intranet/news/{id}", name="news_show", requirements={"id" = "\d+"})
     * @Route("/rss/{id}", name="oneNews_rss_show", requirements={"id" = "\d+"})
     * @Template()
     */
    public function showAction($id)
    {
        $em    = $this->getDoctrine()->getManager();
        $news  = $em->getRepository('Market3wSiteBundle:News')->find($id); 
        
        $request = $this->container->get('request');
        $routeName = $request->get("_route");
        if($routeName=="oneNews_rss_show"){
           return $this->render("Market3wSiteBundle:rssOneNews.xml.twig", array('news'=>$news));
        }
        
        return array('news'=>$news);
    }
    
}
