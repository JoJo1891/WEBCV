<?php

namespace App\Repository;

use App\Entity\ContactInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactInformation[]    findAll()
 * @method ContactInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactInformation::class);
    }

    // /**
    //  * @return ContactInformation[] Returns an array of ContactInformation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactInformation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
