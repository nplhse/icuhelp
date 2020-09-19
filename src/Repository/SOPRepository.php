<?php

namespace App\Repository;

use App\Entity\SOP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SOP|null find($id, $lockMode = null, $lockVersion = null)
 * @method SOP|null findOneBy(array $criteria, array $orderBy = null)
 * @method SOP[]    findAll()
 * @method SOP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SOPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SOP::class);
    }

    // /**
    //  * @return SOP[] Returns an array of SOP objects
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
    public function findOneBySomeField($value): ?SOP
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
