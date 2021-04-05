<?php

namespace App\Repository;

use App\Entity\ContactCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactCategory[]    findAll()
 * @method ContactCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactCategory::class);
    }

    /**
     * @return ContactCategory[] Returns an array of ContactCategory objects
     */
    public function findByNameAlphabetically()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?ContactCategory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
