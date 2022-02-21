<?php

namespace App\Repository;

use App\Entity\Automotive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Automotive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Automotive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Automotive[]    findAll()
 * @method Automotive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutomotiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Automotive::class);
    }

    // /**
    //  * @return Automotive[] Returns an array of Automotive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Automotive
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
