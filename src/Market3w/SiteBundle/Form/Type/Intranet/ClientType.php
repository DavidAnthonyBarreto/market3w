<?php

namespace Market3w\SiteBundle\Form\Type\Intranet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Market3w\SiteBundle\Form\Type\CompanyType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', 'choice', array(
            'label'    => 'Type', 
            'choices'  => array('ROLE_PROSPECT' => 'Prospect', 'ROLE_CLIENT' => 'Client'),
            'expanded' => true,
            'multiple' => false,
            'mapped'   => false,
            'required' => true
        ));
        
        $builder->add('lastName', 'text', array(
            'label'              => 'form.lastName', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('firstName', 'text', array(
            'label'              => 'form.firstName', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('email', 'email', array(
            'label'              => 'form.email', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('phoneNumber', 'text', array(
            'label'              => 'form.phoneNumber', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('mobilePhoneNumber', 'text', array(
            'label'              => 'form.mobilePhoneNumber', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('company', new CompanyType(), array(
            'label'              => 'form.company',
            'translation_domain' => 'FOSUserBundle',
            'required'           => true,
        ));           
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Market3w\SiteBundle\Entity\User'
        ));
    }
    
    public function getName()
    {
        return 'new_client';
    }
}
