<?php

namespace App\Repository;

use App\Entity\Paymnet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paymnet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paymnet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paymnet[]    findAll()
 * @method Paymnet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymnetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paymnet::class);
    }

    // /**
    //  * @return Paymnet[] Returns an array of Paymnet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Paymnet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
