<?php

namespace App\Repository;

use App\Entity\Tuto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tuto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tuto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tuto[]    findAll()
 * @method Tuto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tuto::class);
    }

    // /**
    //  * @return Tuto[] Returns an array of Tuto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tuto
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
