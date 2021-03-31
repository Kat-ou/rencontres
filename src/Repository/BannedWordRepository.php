<?php

namespace App\Repository;

use App\Entity\BannedWord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BannedWord|null find($id, $lockMode = null, $lockVersion = null)
 * @method BannedWord|null findOneBy(array $criteria, array $orderBy = null)
 * @method BannedWord[]    findAll()
 * @method BannedWord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BannedWordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BannedWord::class);
    }

    // /**
    //  * @return BannedWord[] Returns an array of BannedWord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BannedWord
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
