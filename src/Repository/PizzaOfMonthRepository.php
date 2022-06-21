<?php

namespace App\Repository;

use App\Entity\PizzaOfMonth;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PizzaOfMonth|null find($id, $lockMode = null, $lockVersion = null)
 * @method PizzaOfMonth|null findOneBy(array $criteria, array $orderBy = null)
 * @method PizzaOfMonth[]    findAll()
 * @method PizzaOfMonth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzaOfMonthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PizzaOfMonth::class);
    }

    public function getForCurrentMonth()
    {
        $dt = new DateTime();
        $qb = $this->createQueryBuilder('p');

        $qb->andWhere(
            $qb->expr()->andX(
                $qb->expr()->eq('p.year', ':year'),
                $qb->expr()->eq('p.month', ':month'),
                $qb->expr()->eq('p.active', ':active')
            )
        );

        $qb->setParameter('year', $dt->format('Y'));
        $qb->setParameter('month', intval($dt->format('m')));
        $qb->setParameter('active', true);

        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return PizzaOfMonth[] Returns an array of PizzaOfMonth objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PizzaOfMonth
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
