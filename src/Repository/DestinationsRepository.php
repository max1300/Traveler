<?php

namespace App\Repository;

use App\Entity\Destinations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Destinations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Destinations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Destinations[]    findAll()
 * @method Destinations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destinations::class);
    }

    public function getDestinationsWithLatLng():array
    {
        return $this->createQueryBuilder('d')
            ->where('d.lat IS NOT NULL')
            ->andWhere('d.lng IS NOT NULL')
            ->getQuery()
            ->getResult();

    }

    // /**
    //  * @return Destinations[] Returns an array of Destinations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Destinations
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
