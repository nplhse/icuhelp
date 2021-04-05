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
    public function findAllByName(?string $q)
    {
        $qb = $this->createQueryBuilder('s')
            ->innerJoin('s.tag', 'tag');

        if ($q) {
            $qb->andWhere('s.name LIKE :q OR s.description LIKE :q OR tag.name LIKE :q')
                ->setParameter('q', '%'.$q.'%')
            ;
        }

        return $qb
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return SOP[] Returns an array of Note objects
     */
    public function findAllByTag($tag, ?string $q)
    {
        $qb = $this->createQueryBuilder('s');

        if ($q) {
            $qb->andWhere('s.name LIKE :q OR s.description LIKE :q')
                ->setParameter('q', '%'.$q.'%')
            ;
        }

        return $qb
            ->andWhere('t.id = :tag')
            ->setParameter('tag', $tag)
            ->leftJoin('s.tag', 't')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
