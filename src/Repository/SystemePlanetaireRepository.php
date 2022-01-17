<?php

namespace App\Repository;

use App\Entity\SystemePlanetaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SystemePlanetaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method SystemePlanetaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method SystemePlanetaire[]    findAll()
 * @method SystemePlanetaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SystemePlanetaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SystemePlanetaire::class);
    }

    // /**
    //  * @return SystemePlanetaire[] Returns an array of SystemePlanetaire objects
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
    public function findOneBySomeField($value): ?SystemePlanetaire
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
