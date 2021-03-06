<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BillStatusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BillStatusRepository extends EntityRepository
{
    public function findStatusForBill()
    {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->in('s.id', array(1,2,3)));
        
        return $qb->getQuery()->getResult();
    }
    
    public function findStatusForEstimate()
    {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->in('s.id', array(4,5,6,7)));
        
        return $qb->getQuery()->getResult();
    }
    
}
