<?php

namespace App\Repository;

use App\Entity\Jobs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jobs>
 *
 * @method Jobs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jobs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jobs[]    findAll()
 * @method Jobs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jobs::class);
    }

    public function save(Jobs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Jobs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function orderBy()
    {
        return $this->createQueryBuilder('j')
            ->orderBy('j.jobDegree', 'DESC')
            ->getQuery()
            ->getResult();

    }

    public function orderByMatch($jobSkill, $userSkill)
    {
        return $this->createQueryBuilder('j')
            ->setParameters(['jobSkills' => $jobSkill, 'userSkills' => $userSkill])
            ->where('j.jobSkills = :jobSkills')
            ->andWhere('j.jobSkills = :userSkills')
            ->getQuery()
            ->getResult();
    }

    public function orderBySkill($jobSkill)
    {
        return $this->createQueryBuilder('j')
            ->setParameters(['jobSkills' => $jobSkill])
            ->where('j.jobSkills = :jobSkills')
            ->getQuery()
            ->getResult();
    }

    public function getJobsSkills()
    {
        return $this->createQueryBuilder('j')
            ->select('j.jobSkills')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Jobs[] Returns an array of Jobs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Jobs
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
