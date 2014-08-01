<?php

namespace Market3w\SiteBundle\Form\Type\Intranet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Market3w\SiteBundle\Form\Type\CompanyType;

class ClientInfoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', null, array(
                'label'              => 'form.firstName', 
                'translation_domain' => 'FOSUserBundle',
                'required'           => true
        ));
        
        $builder->add('lastName', null, array(
            'label'              => 'form.lastName', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('phoneNumber', null, array(
            'label'              => 'form.phoneNumber', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('mobilePhoneNumber', null, array(
            'label'              => 'form.mobilePhoneNumber', 
            'translation_domain' => 'FOSUserBundle',
            'required'           => true
        ));
        
        $builder->add('company', new CompanyType(), array(
            'label' => 'form.company',
            'translation_domain' => 'FOSUserBundle',
            'required' => true,
        ));
        
        // add facture & devis
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

    /**
     * @return string
     */
    public function getName()
    {
        return 'market3w_sitebundle_client_info';
    }
}
