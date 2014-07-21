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
        // si l'utilisateur n'est pas connecté, 
        // il est redirigé vers la page de connexion
        if( !$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        
        $user = $this->container->get('security.context')->getToken()->getUser();

        // form
        $appointment = new Appointment();
        $appointment->setProspect($user);
        
        $form = $this->createForm(new AppointmentType(), $appointment);
        
        $form->handleRequest($request);
        var_dump($form->getData());
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appointment);
            $em->flush();
        }

        
        return array('form'=>$form->createView());
    }
}
