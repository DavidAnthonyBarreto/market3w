<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstLine', 'text', array(
            'label' => 'Adresse',
            'required' => true
        ));
        $builder->add('secondLine', 'text', array(
            'label' => 'Adresse (suite)',
            'required' => false
        ));
        $builder->add('thirdLine', 'text', array(
            'label' => 'Adresse (suite)',
            'required' => false
        ));
        $builder->add('zipcode', 'text', array(
            'label' => 'Code postal',
            'required' => true,
        ));
        $builder->add('city', 'text', array(
            'label' => 'Ville',
            'required' => true
        ));
        
        $builder->add('country', 'text', array(
            'label' => 'Pays',
            'required' => true,
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Market3w\SiteBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'market3w_sitebundle_address';
    }
}
