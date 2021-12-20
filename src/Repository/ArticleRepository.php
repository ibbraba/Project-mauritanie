<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,Article::class);
    }

    public function findAllByTag($tag){
        return $this->createQueryBuilder('a')
            ->andWhere('a.tag = :tag')
            ->setParameter('tag', $tag)
            ->orderBy('views', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }




    // /**
    //  * @return Article[] Returns an array of Article objects
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


    public function ffindIndexArticles(): ?Article
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.date', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Article[]
     */
    public function findIndexArticles(): array{
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\Article a'

        )->setMaxResults(3);

        return $query->getResult();
    }

}
