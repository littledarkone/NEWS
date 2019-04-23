<?php

namespace App\Repository;

use App\Entity\NewsScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NewsScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsScore[]    findAll()
 * @method NewsScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsScoreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NewsScore::class);
    }

    // /**
    //  * @return NewsScore[] Returns an array of NewsScore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsScore
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
