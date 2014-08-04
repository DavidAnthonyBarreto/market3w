<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BillRepository extends EntityRepository
{
    public function findForClient($clientId, $type) 
    {
        $qb = $this->createQueryBuilder('b');
        
        $qb->andWhere('b.client = :client')
           ->setParameter('client', $clientId);
        
        $qb->andWhere('b.type = :type')
           ->setParameter('type', $type);
        
        $qb->orderBy('b.createdAt', 'ASC');
        
        return $qb;
    }
    
    public function findBillForClient($clientId) 
    {
        return $this->findForClient($clientId, 2)->getQuery()->getResult();
    }
    
    public function findEstimateForClient($clientId) 
    {
        return $this->findForClient($clientId, 1)->getQuery()->getResult();
    }    
}
