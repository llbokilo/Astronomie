<?php

namespace App\Repository;

use App\Entity\SuperamasGalaxies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuperamasGalaxies|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperamasGalaxies|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperamasGalaxies[]    findAll()
 * @method SuperamasGalaxies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperamasGalaxiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuperamasGalaxies::class);
    }

    // /**
    //  * @return SuperamasGalaxies[] Returns an array of SuperamasGalaxies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SuperamasGalaxies
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
