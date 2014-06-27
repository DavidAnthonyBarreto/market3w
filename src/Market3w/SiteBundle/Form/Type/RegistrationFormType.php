<?php

namespace Market3w\SiteBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('lastName')
                ->add('firstName')
                ->add('phoneNumber')
                ->add('mobilePhoneNumber')
                ->add('company')
        ;
    }

    public function getName()
    {
        return 'market3w_user_registration';
    }
}
