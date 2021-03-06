<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType 
{
    public function getName()
    {
        return 'market3w_user_profile';
    }
    
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);
        
        $builder->add('firstName', null, array(
                'label' => 'form.firstName', 
                'translation_domain' => 'FOSUserBundle'
        ));
        
        $builder->add('lastName', null, array(
            'label' => 'form.lastName', 
            'translation_domain' => 'FOSUserBundle'
        ));
        
        $builder->add('phoneNumber', null, array(
            'label' => 'form.phoneNumber', 
            'translation_domain' => 'FOSUserBundle'
        ));
        
        $builder->add('mobilePhoneNumber', null, array(
            'label' => 'form.mobilePhoneNumber', 
            'translation_domain' => 'FOSUserBundle'
        ));
                
        $builder->add('company', new CompanyType(), array(
            'label' => 'form.company',
            'translation_domain' => 'FOSUserBundle',
            'required' => true,
        ));
    }
}
