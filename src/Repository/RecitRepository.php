<?php

namespace App\Repository;

use App\Entity\Recit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recit[]    findAll()
 * @method Recit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recit::class);
    }

    public function findAllByTag(string $tag): array
    {/*
        $entityManager = $this->getEntityManager();
        $entityManager->createQuery("SELECT * FROM App\Entity\Recit r INNER JOIN recit_tag ON (recit_id = r.id)
        WHERE tag_id = :tag")
        ->setParameter("tag", $tag);*/





        return $this->createQueryBuilder('e')
            ->addSelect("")
            ->join('e.recit_tag', 't')
            ->Where('t.tag = :tag')

            ->setParameter('tag', $tag)
            ->orderBy('views', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }




    /*
     *
     */

    /**
    //  * @return Recit[] Returns an array of Recit objects
    //  */
    public function findIndexRecits(): array {
    $entitymanager = $this->getEntityManager();

    $query = $entitymanager->createQuery("SELECT a
            FROM App\Entity\Recit a")
        ->setMaxResults(3);

    return $query->getResult();

    }


    /*
    public function findOneBySomeField($value): ?Recit
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
