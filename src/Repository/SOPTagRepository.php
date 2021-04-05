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

    /**
     * @return SOPTag[] Returns an array of ContactCategory objects
     */
    public function findByNameAlphabetically()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
