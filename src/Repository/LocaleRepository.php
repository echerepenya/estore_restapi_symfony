<?php

namespace App\Repository;

use App\Entity\Locale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Locale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locale[]    findAll()
 * @method Locale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locale::class);
    }

    // /**
    //  * @return Locale[] Returns an array of Locale objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Locale
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return array
     */
    public function findUsedLocale(): array
    {
        $qb = $this->createQueryBuilder(alias: 'l')
            ->select(select: array('l.id', 'l.iso1'))
            ->distinct()
            ->innerJoin(join: 'l.country', alias: 'c')
            ->innerJoin(join: 'c.vatRates', alias: 'v')
            ->innerJoin(join: 'v.category', alias: 'ca')
            ->innerJoin(join: 'ca.products', alias: 'p');

    $query = $qb->getQuery();
    return $query->execute();
    }
}
