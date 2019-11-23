<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\VacationRequest;
use App\Entity\User;

class VacationRequestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VacationRequest::class);
    }

    /**
     *
     * @param string $statusName
     * @param User $user
     * @return array
     */
    public function findByStatusName ($statusName, User $user = null)
    {

        $qb = $this->createQueryBuilder('u')
                ->orderBy('u.updatedAt', 'ASC');

        if ($user) {
            $qb->andWhere('u.user = :user')
            ->setParameter("user", $user);
        }

        $qb->innerJoin('u.requestStatus', 'r')
            ->andWhere('r.name = :name')
            ->setParameter('name', $statusName);

         return $qb->getQuery()->getResult();
    }
}
