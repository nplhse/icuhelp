<?php

namespace App\Repository;

use App\Entity\Upload;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Upload|null find($id, $lockMode = null, $lockVersion = null)
 * @method Upload|null findOneBy(array $criteria, array $orderBy = null)
 * @method Upload[]    findAll()
 * @method Upload[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Upload::class);
    }

    /**
     * @return Upload[] Returns an array of Upload objects
     */
    public function findByNote($id)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.note_id = :val')
            ->setParameter('val', $id)
            ->orderBy('u.originalName', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Upload[] Returns an array of Upload objects
     */
    public function findOneByPath($path)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.name = :val')
            ->setParameter('val', $path)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }
}
