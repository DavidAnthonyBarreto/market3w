<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

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
        
        $builder->add('company', 'text', array(
            'label'              => 'form.company', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
    }

    public function getName()
    {
        return 'market3w_user_registration';
    }
}
