<?php

namespace App\Repository;

use App\Entity\Fournit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fournit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fournit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fournit[]    findAll()
 * @method Fournit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FournitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fournit::class);
    }

    // /**
    //  * @return Fournit[] Returns an array of Fournit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fournit
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
