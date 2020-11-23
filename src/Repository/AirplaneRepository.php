<?php

namespace App\Repository;

use App\Entity\Airplane;
use App\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Airplane|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airplane|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airplane[]    findAll()
 * @method Airplane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirplaneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airplane::class);
    }

    // /**
    //  * @return Airplane[] Returns an array of Airplane objects
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
    public function findOneBySomeField($value): ?Airplane
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Airplane[] Returns an array of Airplane objects
     */
    public function findAllAirplanes()
    {
        $qb = $this->getQueryBuilder();

        $qb
            ->select('
                airplane.id as id,
                airplane.name as name,
                cities.name as city
            ')
            ->innerJoin(City::class,'cities','WITH','cities.id = airplane.local')
            ->orderBy('id','ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Airplane[] Returns an array of Airplane objects
     */
    public function findValidAirplanes($local)
    {
        $qb = $this->getQueryBuilder();

        $qb
            ->select('
                airplane.id as id,
                airplane.name as name
            ')
            ->where('airplane.is_valid = :isValid')
            ->andWhere('airplane.local = :local')
            ->setParameter('isValid',true)
            ->setParameter('local',$local)
            ->orderBy('id','ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $queryBuilder = $em
            ->getRepository(Airplane::class)
            ->createQueryBuilder('airplane')
        ;

        return $queryBuilder;
    }
}
