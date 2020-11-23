<?php

namespace App\Repository;

use App\Entity\Ripd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ripd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ripd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ripd[]    findAll()
 * @method Ripd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RipdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ripd::class);
    }

    // /**
    //  * @return Ripd[] Returns an array of Ripd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ripd
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
