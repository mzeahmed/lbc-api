<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use function Symfony\Component\String\u;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    /**
     * @param string $query
     * @param int    $limit
     *
     * @return float|int|mixed|string
     */
    public function findBySearchQuery(string $query, int $limit = 3): mixed
    {
        $searchTerms = $this->extractSearchTerms($query);
        $qb = $this->createQueryBuilder('a');

        foreach ($searchTerms as $key => $term) {
            $qb
                ->join('a.vehicle', 'av')
                ->where('av.name LIKE :t_' . $key)
                ->setParameter('t_' . $key, '%' . $term . '%')
            ;
        }

        return $qb->getQuery()->setMaxResults($limit)->execute();
    }

    /**
     * @param string $searchQuery
     *
     * @return array
     */
    private function extractSearchTerms(string $searchQuery): array
    {
        $searchQuery = u($searchQuery)->replaceMatches('/[[:space:]]+/', ' ')->trim();
        $terms = array_unique($searchQuery->split(' '));

        return array_filter($terms, static function ($term) {
            return 2 <= $term->length();
        });
    }
}
