<?php

namespace App\Repository;

use App\Entity\Regions;
use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    public function findAllRestaurants($value, $regions)
    {
        $qb =  $this->createQueryBuilder('r');
        if ($value) {
            $qb->andWhere('r.name LIKE :value')
                ->setParameter('value','%'.$value.'%');
        }
        if ($regions == Regions::PRISHTINE) {
            $qb->andWhere('r.region = :regions')
                ->setParameter('regions', $regions);
        }
        if ($regions == Regions::MITROVICE) {
            $qb->andWhere('r.region = :regions')
                ->setParameter('regions', $regions);
        }
        if ($regions == Regions::GJILAN) {
            $qb->andWhere('r.region = :regions')
                ->setParameter('regions', $regions);

        }
        if ($regions == Regions::PRIZREN) {
            $qb->andWhere('r.region = :regions')
                ->setParameter('regions', $regions);
        }
        if ($regions == Regions::FERIZAJ) {
            $qb->andWhere('r.region = :regions')
                ->setParameter('regions', $regions);
        }
        if ($regions == Regions::PEJE) {
            $qb->andWhere('r.region = :regions')
                ->setParameter('regions', $regions);
        }
        if ($regions == Regions::GJAKOVE) {
            $qb->andWhere('r.region = :regions')
                ->setParameter('regions', $regions);
        }
        return $qb
            ->orderBy('r.id','DESC')
            ->getQuery()
            ->getResult();
    }

    public function countRestaourants()
    {
        return $this->createQueryBuilder('rt')
            ->select('COUNT(rt.id) as id')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findByRegion($regionId)
    {
        return $this->createQueryBuilder('r')
            ->select('r')
            ->where('r.region',$regionId);
    }

    public function myRestaturant($userId)
    {
        $qb =  $this->createQueryBuilder('r')
            ->select('r')
            ->where('r.userId = 4');
        return $qb->getQuery()->getResult();
    }

}
