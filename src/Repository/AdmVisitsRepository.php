<?php

namespace App\Repository;

use App\Entity\AdmVisits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AdmVisits|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmVisits|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmVisits[]    findAll()
 * @method AdmVisits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmVisitsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdmVisits::class);
    }

    // /**
    //  * @return AdmVisits[] Returns an array of AdmVisits objects
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
    public function findOneBySomeField($value): ?AdmVisits
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
