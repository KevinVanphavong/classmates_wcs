<?php

namespace App\Repository;

use App\Entity\WilderImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WilderImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method WilderImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method WilderImage[]    findAll()
 * @method WilderImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WilderImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WilderImage::class);
    }

    // /**
    //  * @return WilderImage[] Returns an array of WilderImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WilderImage
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
