<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class HourForAppointmentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('startTime', 'choice', array(
            'label'     => "A quelle heure souhaitez-vous rencontrer le conseiller ? ",
            'choices'   => array('10:00' => '10:00', '11:00' => '11:00', '15:00' => '15:00', '16:00' => '16:00' ),
            'expanded'  => true,
            'multiple'  => false,
            'required'  => true,
        ));
        
        $builder->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPreSetData'));
    }
    
    public function onPreSetData(FormEvent $event)
    {
        $hour = $event->getData();
        $form = $event->getForm();
        
        $hourString   = $hour->getStartTime();
        $hourDatetime = date_create_from_format('H:i', $hourString);
        $hour->setStartTime($hourDatetime);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Market3w\SiteBundle\Entity\Hour'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'market3w_sitebundle_hour';
    }
}
