<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllUsers($value)
    {
        $qb = $this->createQueryBuilder('u');
        if ($value) {
            $qb->andWhere('u.name LIKE :value OR u.lastname LIKE :value OR u.city LIKE :value OR u.number LIKE :value
                            OR u.email LIKE :value OR u.username LIKE :value')
                ->setParameter('value', '%' . $value . '%');
        }
        return $qb->orderBy('u.create_date', 'DESC')
            ->getQuery();
    }

    public function countUsers()
    {
        return $this->createQueryBuilder('rt')
            ->select('COUNT(rt.id) as id')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
