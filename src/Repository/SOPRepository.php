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

    /**
     * @return SOP[] Returns an array of Note objects
     */
    public function findAllByName()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
