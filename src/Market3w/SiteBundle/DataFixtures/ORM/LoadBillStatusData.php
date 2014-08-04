<?php

namespace Market3w\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Market3w\SiteBundle\Entity\BillStatus;

class LoadBillStatusData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $status = $this->getStatus();
        
        foreach($status as $name) 
        {
            $status = new BillStatus();
            $status->setName($name);
            
            $manager->persist($status);
        }
       
        $manager->flush();
    }
    
    private function getStatus()
    {
        $status = array(
            "En attente de paiement",
            "Payée",
            "Paiement refusé",
            "En attente de réponse",
            "Accepté",
            "Refusé",
            "Expiré",           
        );
        
        return $status;
    }
}
