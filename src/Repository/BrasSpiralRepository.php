<?php

namespace App\Repository;

use App\Entity\BrasSpiral;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BrasSpiral|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrasSpiral|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrasSpiral[]    findAll()
 * @method BrasSpiral[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrasSpiralRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrasSpiral::class);
    }

    // /**
    //  * @return BrasSpiral[] Returns an array of BrasSpiral objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BrasSpiral
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
