<?php

namespace App\Repository;

use App\Entity\Voo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voo[]    findAll()
 * @method Voo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VooRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voo::class);
    }

    // /**
    //  * @return Voo[] Returns an array of Voo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voo
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
