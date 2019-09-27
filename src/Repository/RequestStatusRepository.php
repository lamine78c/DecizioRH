<?php

namespace App\Repository;

use App\Entity\RequestStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nimportequoi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nimportequoi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nimportequoi[]    findAll()
 * @method Nimportequoi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequestStatus::class);
    }

    // /**
    //  * @return Nimportequoi[] Returns an array of Nimportequoi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nimportequoi
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
