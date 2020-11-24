<?php

namespace App\Repository;

use App\Entity\ProfessionalCourse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfessionalCourse|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfessionalCourse|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfessionalCourse[]    findAll()
 * @method ProfessionalCourse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionalCourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfessionalCourse::class);
    }

    // /**
    //  * @return ProfessionalCourse[] Returns an array of ProfessionalCourse objects
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
    public function findOneBySomeField($value): ?ProfessionalCourse
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByIdProfessionalCourses($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.idCv = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
