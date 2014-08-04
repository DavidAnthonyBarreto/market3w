<?php

namespace Market3w\SiteBundle\Form\Type\Intranet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class BillLineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->add('service', 'entity', array(
            'label'    => 'Service', 
            'class'    => 'Market3wSiteBundle:Service',
            'property' => 'title',
            'expanded' => false,
            'multiple' => false,
        ));
         
        $builder->add('nbHours', 'integer', array(
            'label'    => "Temps passé",
            'required' => true
        ));
        
        $builder->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPostSubmit'));
    }
    
    public function onPostSubmit(FormEvent $event)
    {
        $billLine = $event->getData();
        $form     = $event->getForm();
        
        $service = $billLine->getService();
        
        $billLine->setService($service->getTitle());
        $billLine->setPrice($service->getPrice());
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Market3w\SiteBundle\Entity\BillLine'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'market3w_sitebundle_billline';
    }
}
