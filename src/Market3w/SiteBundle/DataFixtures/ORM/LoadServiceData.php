<?php

namespace Market3w\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Market3w\SiteBundle\Entity\Service;

class LoadServiceData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $services = $this->getServices();
        
        foreach($services as $title => $price) 
        {
            $service = new Service();
            $service->setTitle($title);
            $service->setPrice($price);
            
            $manager->persist($service);
        }
       
        $manager->flush();
    }
    
    private function getServices()
    {
        $services = array(
            "Référencement naturel" => 8,
            "Etude marketing"       => 10,
            "E-commerce"            => 9,
            "Marketing mobile"      => 11
        );
        
        return $services;
    }
}
