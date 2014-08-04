<?php

namespace Market3w\SiteBundle\Form\Type\Intranet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Market3w\SiteBundle\Form\Type\Intranet\BillLineType;

class BillType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('discount', 'text', array(
            'label'    => 'Remise',
            'required' => true,
        ));
        
        $builder->add('lines', 'collection', array(
            'type'         => new BillLineType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'Market3w\SiteBundle\Entity\Bill',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'market3w_sitebundle_bill';
    }
}
