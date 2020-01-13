<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Vacation;
use App\Entity\User;

class VacationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vacation::class);
    }

    /**
     *
     * @param string $expired
     * @param User $user
     * @return array
     */
    public function findVacations (User $user = null, $expired = false)
    {
        $date = new \DateTime();
        $qb = $this->createQueryBuilder('u')
                ->orderBy('u.period', 'DESC');

        if ($expired === true) {
            $qb->where('u.expiredAt < :expiredAt')
                ->setParameter("expiredAt", $date->format('Y-m-d'));
        } elseif ($expired === false) {
            $qb->where('u.expiredAt >= :expiredAt')
                ->setParameter("expiredAt", $date->format('Y-m-d'));
        }

        if ($user) {
            $qb->andWhere('u.user = :user')
            ->setParameter("user", $user);
        }

         return $qb->getQuery()->getResult();
    }
}
