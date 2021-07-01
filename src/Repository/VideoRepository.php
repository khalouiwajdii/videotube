<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * @param string $search
     * @return Video[]
     */
    public function findBySearch(string $search): array
    {
        // SELECT * FROM video AS v
        $qb = $this->createQueryBuilder('v');

        // ORDER BY v.publishedAt DESC
        $qb->orderBy('v.publishedAt', 'DESC');

        // WHERE v.title LIKE '%search%'
        $qb
            ->where('v.title LIKE :search')
            ->setParameter('search', '%' . $search . '%')
        ;
        // search% => start by $search
        // %search => end by $search
        // %search% => contain $search

        // LIMIT 10
        $qb->setMaxResults(10);

        // SELECT * FROM video AS v WHERE v.title LIKE '%search%' ORDER BY v.publishedAt DESC LIMIT 10
        return $qb->getQuery()->getResult();
    }
}
