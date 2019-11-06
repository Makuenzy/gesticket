<?php

namespace App\Repository;

use App\Entity\RefSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RefSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefSession[]    findAll()
 * @method RefSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefSession::class);
    }

    // /**
    //  * @return RefSession[] Returns an array of RefSession objects
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
    public function findOneBySomeField($value): ?RefSession
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
