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
    public function indexAction()
    {
        $wm           = $this->getUser();
        $appointments = $wm->getAppointments();
  
        return array('appointments' => $appointments);
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

        $appointment = $em->getRepository('Market3wSiteBundle:Appointment')->find($id);

        if (!$appointment) {
            throw $this->createNotFoundException('Impossible de trouver le rendez-vous.');
        }
               
        return array('appointment' => $appointment);
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
        }
        
        return array('form' => $form->createView());
    }
    
    /**
     * Confirm appointment to prospect
     *
     * @Route("/{id}/confirm", name="agenda_confirm_appointment", requirements={"id" = "\d+"})
     * @Template()
     */
    public function confirmAction($id)
    {
        $em          = $this->getDoctrine()->getManager();
        $wm          = $this->getUser();
        $appointment = $em->getRepository('Market3wSiteBundle:Appointment')->find($id);
                
        $message = \Swift_Message::newInstance()
            ->setSubject('Market3w - Confirmation de rendez-vous avec votre conseiller web-marketing')
            ->setFrom($wm->getEmail())
            ->setTo($appointment->getProspect()->getEmail())
            ->setBody($this->renderView('Market3wSiteBundle:Email:confirmAppointment.txt.twig', array('wm' => $wm, 'appointment' => $appointment)))
        ;
        $this->get('mailer')->send($message);
        
        $appointment->setConfirmed(true);
        $em->persist($appointment);
        $em->flush();
        
         $this->get('session')->getFlashBag()->add(
            'notice',
            'Le rendez-vous est confirmé. Un email a été envoyé au prospect.'
        );
        
        return $this->redirect($this->generateUrl('agenda_index'));
    }
}
