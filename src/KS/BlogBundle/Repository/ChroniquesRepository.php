<?php

namespace KS\BlogBundle\Repository;

/**
 * ChroniquesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChroniquesRepository extends \Doctrine\ORM\EntityRepository
{



    public function findChroniquesBooksIfSagaIsNotNull($saga) {

        $qb = $this->createQueryBuilder('c');
        $qb->where($qb->expr()->isNotNull('c.book'))
        ->andWhere('c.saga = :saga')
        ->setParameter('saga', $saga);
    
        return $qb->getQuery()
        ->getResult();
    }
  

 

}
