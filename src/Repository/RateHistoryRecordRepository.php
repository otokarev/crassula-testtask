<?php

namespace App\Repository;

use App\Entity\RateHistoryRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RateHistoryRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method RateHistoryRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method RateHistoryRecord[]    findAll()
 * @method RateHistoryRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateHistoryRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RateHistoryRecord::class);
    }

    // /**
    //  * @return RateHistoryRecord[] Returns an array of RateHistoryRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RateHistoryRecord
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
