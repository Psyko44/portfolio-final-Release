<?php

namespace App\Repository;

use App\Entity\ProjectSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Projects;
use App\Entity\Skills;

/**
 * @extends ServiceEntityRepository<ProjectSkillsPictures>
 *
 * @method ProjectSkillsPictures|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectSkillsPictures|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectSkillsPictures[]    findAll()
 * @method ProjectSkillsPictures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectSkillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectSkills::class);
    }

    //    /**
    //     * @return ProjectSkillsPictures[] Returns an array of ProjectSkillsPictures objects
    //     */
    public function findProjectSkillByProjectsAndSkills(int $projectId, int $skillsId)
    {
        $project = $this->getEntityManager()->getRepository(Projects::class)->find($projectId);
        $skills = $this->getEntityManager()->getRepository(Skills::class)->find($skillsId);

        if (!$project || !$skills) {
            return null; // Return null or handle accordingly
        }

        return $this->createQueryBuilder('ps')
            ->where('ps.project = :project')
            ->andWhere('ps.skills = :skills')
            ->setParameter('project', $project)
            ->setParameter('skills', $skills)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByIds(array $ids): array
    {
        return $this->createQueryBuilder('ps')
            ->andWhere('ps.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}
