<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Market3w\SiteBundle\Form\Type\AppointmentType;

/**
 * Agenda  controller.
 *
 * @Route("/intranet/agenda")
 */
class AgendaController extends Controller 
{
    /**
     * My agenda.
     *
     * @Route("/", name="agenda_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id=null)
    {
        if ($this->container->get('request')->get('_route') == 'api_get_appointments' ){
            $em = $this->getDoctrine()->getManager();
            $appointments = $em->getRepository("Market3wSiteBundle:Appointment")->getAppointments($id);
            
            return new Response(json_encode($appointments));
        }
        else {
            $wm = $this->getUser();
            $appointments = $wm->getAppointments();
            
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $appointments,
                $this->get('request')->query->get('page', 1)/*page number*/,
                10/*limit per page*/
            );
            
            return array('appointments' => $pagination);
        }
    }
    
    /**
     * Detail appointment
     *
     * @Route("/{id}", name="agenda_show_appointment", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        if ($this->container->get('request')->get('_route') == 'api_get_appointment' ){
            
            $appointment = $em->getRepository('Market3wSiteBundle:Appointment')->getDetail($id);
            
            return new Response(json_encode($appointment));
            
        }
        else {
            $appointment = $em->getRepository('Market3wSiteBundle:Appointment')->find($id);

            if (!$appointment) {
                throw $this->createNotFoundException('Impossible de trouver le rendez-vous.');
            }
            
            return array('appointment' => $appointment);
        }
    }
    
    /**
     * Edit appointment
     *
     * @Route("/{id}/edit", name="agenda_edit_appointment", requirements={"id" = "\d+"})
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $wm = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        $appointment = $em->getRepository('Market3wSiteBundle:Appointment')->find($id);

        // appointment type is a service in order to inject security context in it
        $form = $this->createForm($this->get('form.type.appointment'), $appointment);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            // set skype pseudo
            if( !is_null($form['skype']->getData()) ){
                $appointment->getProspect()->setSkypePseudo($form['skype']->getData());
            }
            
            $em->persist($appointment);
            $em->flush();
            
            return $this->redirect($this->generateUrl('agenda_show_appointment', array('id' => $appointment->getId())));
        }
        
        return array('form' => $form->createView());
    }
    /**
     * API Edit appointment
     */
    public function putAction(Request $request)
    {                
        $em = $this->getDoctrine()->getManager();
        $appointment = $em->getRepository('Market3wSiteBundle:Appointment')->find($request->get('id'));

        if ( $request->get('subject') ){
            $appointment->setSubject($request->get('subject'));  
        }
        
        if( $request->get('date') ){
            $date = \DateTime::createFromFormat('j/m/Y', $request->get('date'));  
            $appointment->setDate($date);
        }
        
        if( $request->get('hour') ) {
            $hour = \DateTime::createFromFormat('H:i', $request->get('hour'));
            $appointment->setHour($hour);      
        }
        
        if ( $request->get('type') ){
            $appointmentType = $em->getRepository('Market3wSiteBundle:AppointmentType')->find($request->get('type'));
            if( $appointmentType->getId() ==  1){
                $prospect = $appointment->getProspect();
                $prospect->setSkypePseudo($request);
            }
        }
        
        $em->persist($appointment);
        $em->flush();
        
        return new Response();
    }
    
    
    /**
     * Confirm appointment to prospect
     *
     * @Route("/{id}/confirm", name="agenda_confirm_appointment", requirements={"id" = "\d+"})
     * @Template()
     */
    public function confirmAction($id=null, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        if ($this->container->get('request')->get('_route') == 'api_confirm_appointment' ){
            $id = $request->get('id');
        }
        
        $appointment = $em->getRepository('Market3wSiteBundle:Appointment')->find($id);
                
        $message = \Swift_Message::newInstance()
            ->setSubject('Market3w - Confirmation de rendez-vous avec votre conseiller web-marketing')
            ->setFrom($appointment->getWebMarketeur()->getEmail())
            ->setTo($appointment->getProspect()->getEmail())
            ->setBody($this->renderView('Market3wSiteBundle:Email:confirmAppointment.txt.twig', array('appointment' => $appointment)))
        ;
        $this->get('mailer')->send($message);
        
        $appointment->setConfirmed(true);
        $em->persist($appointment);
        $em->flush();
        
         $this->get('session')->getFlashBag()->add(
            'notice',
            'Le rendez-vous est confirmé. Un email a été envoyé au prospect.'
        );
        
        if ($this->container->get('request')->get('_route') == 'api_confirm_appointment' ){
            return new Response();
        }
        else {
            return $this->redirect($this->generateUrl('agenda_index'));
        }
        
    }
}
