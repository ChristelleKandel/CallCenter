<?php

namespace App\Repository;

use App\Entity\Users;
use App\Entity\Missions;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Missions>
 *
 * @method Missions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Missions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Missions[]    findAll()
 * @method Missions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Missions::class);
    }

    public function save(Missions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Missions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Missions[] Returns an array of Missions objects
    */
   public function findEnqueteByActualDates($today): array
   {
       return $this->createQueryBuilder('m')
           ->andWhere(':today BETWEEN m.date_debut AND m.date_fin')
           ->andWhere('m.type = 1')
           ->setParameter('today', $today)
           ->orderBy('m.date_debut', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }
      /**
    * @return Missions[] Returns an array of Missions objects
    */
    public function findProspectionByActualDates($today): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere(':today BETWEEN m.date_debut AND m.date_fin')
            ->andWhere('m.type = 2')
            ->setParameter('today', $today)
            ->orderBy('m.date_debut', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
       /**
    * @return Missions[] Returns an array of Missions objects
    */
   public function findReceptionByActualDates($today): array
   {
       return $this->createQueryBuilder('m')
           ->andWhere(':today BETWEEN m.date_debut AND m.date_fin')
           ->andWhere('m.type = 3')
           ->setParameter('today', $today)
           ->orderBy('m.date_debut', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

//    /**
//     * @return Missions[] Returns an array of Missions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Missions
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
