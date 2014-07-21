<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateForAppointmentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', 'datetime', array(
            'label'  => 'Quel jour souhaitez-vous rencontrer le conseiller ? ',
            'widget' => 'single_text',
            'date_format' => 'dd/MM/yyyy',
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Market3w\SiteBundle\Entity\Date'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'market3w_sitebundle_date';
    }
}
