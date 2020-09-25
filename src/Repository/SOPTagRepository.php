<?php

namespace App\Repository;

use App\Entity\SOPTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SOPTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method SOPTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method SOPTag[]    findAll()
 * @method SOPTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SOPTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SOPTag::class);
    }

    // /**
    //  * @return SOPTag[] Returns an array of SOPTag objects
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
    public function findOneBySomeField($value): ?SOPTag
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
