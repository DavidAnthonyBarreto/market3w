<?php

namespace Market3w\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Market3w\SiteBundle\Entity\Appointment;
use Market3w\SiteBundle\Form\Type\AppointmentType;

class ContactController extends Controller 
{
    /**
     * @Route("/contact")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
                
        // form
        $appointment = new Appointment();
        $appointment->setProspect($user);
        
        // appointment type is a service in order to inject security context in it
        $form = $this->createForm($this->get('form.type.appointment'), $appointment);

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // assigne web marketeur
            $wmList  = $this->getDoctrine()->getRepository('Market3wSiteBundle:User')->findAvailableWebMarketeur("WEB_MARKETEUR");
            // celui qui a le moins de rdv ce mois-ci
            $wmIndex = array_rand($wmList, 1);
            $wm = $wmList[$wmIndex];
            
            $appointment->setWebMarketeur($wm);
            
            // set skype pseudo
            if( !is_null($form['skype']->getData()) ){
                $user->setSkypePseudo($form['skype']->getData());
            }
            
            $em->persist($appointment);
            $em->flush();
            
            return $this->redirect($this->generateUrl('market3w_site_contact_success'));
        }

        
        return array('form'=>$form->createView());
    }
    
    /**
     * @Route("/contact/merci")
     * @Template()
     */
    public function successAction()
    {
        return array();
    }
    
}
