<?php

namespace App\Repository;

use App\Entity\Buz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Buz>
 *
 * @method Buz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Buz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Buz[]    findAll()
 * @method Buz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Buz::class);
    }

//    /**
//     * @return Buz[] Returns an array of Buz objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Buz
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
