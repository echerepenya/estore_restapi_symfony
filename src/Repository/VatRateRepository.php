<?php

namespace App\Repository;

use App\Entity\VatRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;


/**
 * @method VatRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method VatRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method VatRate[]    findAll()
 * @method VatRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VatRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VatRate::class);
    }

    // /**
    //  * @return VatRate[] Returns an array of VatRate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VatRate
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return array
     */
    public function getFullList(int $p_id = 0, string $l_iso = "0"): array
    {
        $qb = $this->createQueryBuilder(alias: 'v')
            ->select(select: array('v.id', 'v.vat',
                    'cat.name as category', 'ctr.name as country',
                    'p.name as product', 'p.description', 'p.price', '(p.price + p.price*v.vat/100) as gross_price',
                    'l.iso1 as locale', ))
            ->leftJoin(join: 'v.category', alias: 'cat')
            ->innerJoin(join: 'cat.products', alias: 'p')
            ->leftJoin(join: 'v.country', alias: 'ctr')
            ->leftJoin(join: 'ctr.locale', alias: 'l');

        if ($p_id != 0)
        {
            $qb->where('p.id = :p_id')
                ->setParameter('p_id', $p_id);
        }

        if ($l_iso != "0")
        {
            $qb->andWhere('l.iso1 = :l_iso')
                ->setParameter('l_iso', $l_iso);
        }
        
        $query = $qb->getQuery();
        return $query->execute();
        
    }

}
