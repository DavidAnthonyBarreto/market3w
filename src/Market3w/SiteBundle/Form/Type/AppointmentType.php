<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\SecurityContext;

use Market3w\SiteBundle\Form\Type\HourForAppointmentType;
use Market3w\SiteBundle\Form\Type\Intranet\HourForEditAppointmentType;


class AppointmentType extends AbstractType
{
    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('subject', 'textarea', array(
            'label'    => 'Décrivez votre demande : *',
            'attr'     => array('rows' => 4),
            'required' => true
        ));
        
        $builder->add('type', 'entity', array(
            'label'    => 'Comment souhaitez-vous rencontrer le conseiller ? *', 
            'class'    => 'Market3wSiteBundle:AppointmentType',
            'property' => 'name',
            'expanded' => true,
            'multiple' => false,
            'required' => true
        ));
        
        $builder->add('address', new AddressType(), array(
            'required' => false,
        ));
        
        $builder->add('skype', 'text', array(
            'label'    => 'Votre pseudo Skype : *',
            'required' => false,
            'mapped'   => false,
        ));
        
        $builder->add('date', 'date', array(
            'label'    => 'Quel jour souhaitez-vous rencontrer le conseiller ? *',
            'widget'   => 'single_text',
            'format'   => 'dd/MM/yyyy',
            'required' => true
        ));
    
        // prospect is limited in hours choice
        if ($this->securityContext->isGranted('ROLE_PROSPECT')){
            $hours   = range('9', '17');
        }
        else {
            $hours   = range('0', '23');
        }

        $builder->add('hour', 'time', array(
            'label'    => "A quelle heure souhaitez-vous rencontrer le conseiller ? *",
            'hours'    => $hours,
            'minutes'  => range('0', '59', '15'),
            'required' => true
        ));       
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
