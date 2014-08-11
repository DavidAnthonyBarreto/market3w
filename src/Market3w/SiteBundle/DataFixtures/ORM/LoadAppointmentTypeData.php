<?php

namespace Market3w\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Market3w\SiteBundle\Entity\AppointmentType;

class LoadAppointmentTypeData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $types = $this->getTypes();
        
        foreach($types as $name) 
        {
            $type = new AppointmentType();
            $type->setName($name);
            
            $manager->persist($type);
        }
       
        $manager->flush();
    }
    
    private function getTypes()
    {
        $types = array(
            "Physiquement",
            "Videoconférence (via Skype)",
        );
        
        return $types;
    }
}
