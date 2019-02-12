<?php

namespace App\Repository;

use App\Entity\Bookings;
use App\Entity\Regions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bookings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookings[]    findAll()
 * @method Bookings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bookings::class);
    }

    public function findByBooking($regions, $value, $fromDate, $toDate, $request)
    {
        $qb = $this->createQueryBuilder('b')
            ->leftJoin('b.restaurantId','r')
            ;
        if ($fromDate or $toDate != null) {
            $qb->andWhere('b.bookingDate >= :fromDate')
                ->setParameter('fromDate', $fromDate)
                ->andWhere('b.bookingDate <= :toDate')
                ->setParameter('toDate', $toDate);
        }
        if ($value) {
            $qb->andWhere('r.name LIKE :value ')
                ->setParameter('value', '%' . $value . '%');
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
        if (!empty($request->query->get('search')['period'])) {
            $qb->andWhere('b.period = :period')
                ->setParameter('period', Regions::PERIOD_NIGHT);
        }
        if ($request->query->get('search') != null) {
            if (!array_key_exists('period', $request->query->get('search'))) {
                $qb->andWhere('b.period = :period')
                    ->setParameter('period', Regions::PERIOD_DAY);
            }
        }
        if (!empty($request->query->get('search')['reserved'])) {
            $qb->andWhere('b.status = :status')
                ->setParameter('status', Regions::BOOKING);
        }
        if ($request->query->get('search') != null) {
            if (!array_key_exists('reserved', $request->query->get('search'))) {
                $qb->andWhere('b.status = :status')
                    ->setParameter('status', Regions::UNBOOKING);
            }
        }

        return $qb
            ->orderBy('r.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Bookings
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
