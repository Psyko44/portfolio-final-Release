<?php

namespace App\Repository;

use App\Entity\ContactMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactMesages>
 *
 * @method ContactMesages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactMesages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactMesages[]    findAll()
 * @method ContactMesages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactMessages::class);
    }

    //    /**
    //     * @return ContactMesages[] Returns an array of ContactMesages objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ContactMesages
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
