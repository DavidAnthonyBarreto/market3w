<?php

namespace Market3w\SiteBundle\Form\Type\Intranet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeoEditStatisticsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt', 'date', array(
                'label' => 'Date du rdv',
                //'data' => '01/01/1990',
                'read_only' => true,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'datepicker'),
                'required' => true,
            ))
            ->add('uniqueVisitors', 'text', array(
                'label' => 'Nombre de visiteurs uniques',
                'required' => true,
            ))
            ->add('rank', 'text', array(
                'label' => 'Classement',
                'required' => true,
            ))
            ->add('nbViewedPages', 'text', array(
                'label' => 'Nombre de pages vues',
                'required' => true,
            ))
            ->add('reboundTime', 'text', array(
                'label' => 'Taux de rebond',
                'required' => true,
            ))
            ->add('keywords', 'text', array(
                'label' => 'Mots clés',
                'required' => true,
            ))
            ->add('topViewed', 'text', array(
                'label' => 'Pages les plus vues',
                'required' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Market3w\SiteBundle\Entity\SeoStatistics'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'market3w_sitebundle_seostatistics';
    }
}
