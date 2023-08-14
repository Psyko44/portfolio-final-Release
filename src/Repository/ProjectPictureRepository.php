<?php

namespace App\Repository;

use App\Entity\ProjectPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectPicture>
 *
 * @method ProjectPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectPicture[]    findAll()
 * @method ProjectPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectPicture::class);
    }

    public function findByIds(array $ids): array
    {
        return $this->createQueryBuilder('pp')
            ->andWhere('pp.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?ProjectPicture
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
