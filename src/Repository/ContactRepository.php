<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @return Contact[] Returns an array of Note objects
     */
    public function findAllByName(?string $q)
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.category', 'cat');

        if ($q) {
            $qb->where('c.name LIKE :q OR cat.name LIKE :q')
                ->setParameter('q', '%'.$q.'%')
            ;
        }

        return $qb
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Contact[] Returns an array of Note objects
     */
    public function findAllByCategory($category, ?string $q)
    {
        $qb = $this->createQueryBuilder('c');

        if ($q) {
            $qb->andWhere('c.name LIKE :q')
                ->setParameter('q', '%'.$q.'%')
            ;
        }

        return $qb
            ->andWhere('c.category = :category')
            ->setParameter('category', $category)
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
