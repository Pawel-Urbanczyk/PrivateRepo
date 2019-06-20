<?php

namespace App\Repository;

use App\Entity\AllegroCSV;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AllegroCSV|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllegroCSV|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllegroCSV[]    findAll()
 * @method AllegroCSV[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllegroCSVRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AllegroCSV::class);
    }

    // /**
    //  * @return AllegroCSV[] Returns an array of AllegroCSV objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AllegroCSV
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
