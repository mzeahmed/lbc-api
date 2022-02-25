<?php

namespace App\Repository;

use App\Entity\Automotive;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
}
