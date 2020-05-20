<?php

namespace App\Repository;

use App\Entity\SnippetCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SnippetCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SnippetCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SnippetCategory[]    findAll()
 * @method SnippetCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SnippetCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SnippetCategory::class);
    }

    // /**
    //  * @return SnippetCategory[] Returns an array of SnippetCategory objects
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
    public function findOneBySomeField($value): ?SnippetCategory
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
