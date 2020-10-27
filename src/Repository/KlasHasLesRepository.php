<?php

namespace App\Repository;

use App\Entity\KlasHasLes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KlasHasLes|null find($id, $lockMode = null, $lockVersion = null)
 * @method KlasHasLes|null findOneBy(array $criteria, array $orderBy = null)
 * @method KlasHasLes[]    findAll()
 * @method KlasHasLes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlasHasLesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KlasHasLes::class);
    }

    // /**
    //  * @return KlasHasLes[] Returns an array of KlasHasLes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KlasHasLes
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
