<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Market3w\SiteBundle\Form\Type\HourForAppointmentType;
use Market3w\SiteBundle\Form\Type\Intranet\HourForEditAppointmentType;


class AppointmentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('subject', 'textarea', array(
            'label' => 'Décrivez votre demande',
            'attr'     => array('rows' => 4),            
        ));
        
        $builder->add('type', 'entity', array(
            'label'    => 'Comment souhaitez-vous rencontrer le conseiller ?', 
            'class'    => 'Market3wSiteBundle:AppointmentType',
            'property' => 'name',
            'expanded' => true,
            'multiple' => false,
        ));
        
        $builder->add('address', new AddressType(), array(
            'required' => false,
        ));
        
        $builder->add('skype', 'text', array(
            'label'    => 'Votre pseudo Skype',
            'required' => false,
            'mapped'   => false,
        ));
        
        $builder->add('date', new DateForAppointmentType(), array(
            'required' => true
        ));
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
    }
    
    public function onPreSetData(FormEvent $event)
    {
        $appointment = $event->getData();
        $form        = $event->getForm();
        
        if( !is_null($appointment->getHour()) ) {
            $form->add('hour', new HourForEditAppointmentType(), array(
                'required' => true
            ));
        }
        else {
             $form->add('hour', new HourForAppointmentType(), array(
                'required' => true
            ));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Market3w\SiteBundle\Entity\Appointment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appointment';
    }
}
