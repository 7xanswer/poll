<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    // /**
    //  * @return Question[] Returns an array of Question objects
    //  */
    
    public function findByQuestionByUser($value)
    {
        return $this->createQueryBuilder('q')
            ->select('q.id')
            ->andWhere('q.user = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByQuestionByUser2($value)
    {
        return $this->createQueryBuilder('q')
        ->andWhere('q.user = :val')
        ->setParameter('val', $value)
        ->orderBy('q.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
    ;
     }

    public function findInfoQuestion($value): ?array
    {
        return $this->createQueryBuilder('q')
            ->select('q.label,q.id')
            ->andWhere('q.user = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findQuestion(): ?array
    {
        return $this->createQueryBuilder('q')
            ->select('q.label, q.id')
            ->getQuery()
            ->setMaxResults(10)
            ->getResult()
        ;
    }
}
