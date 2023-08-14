<?php

namespace App\Entity;

use App\Repository\ProjectSkillsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectSkillsRepository::class)]
class ProjectSkills
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'projectSkills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Projects $project = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'projectSkills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Skills $skills = null;





    public function getProject(): ?Projects
    {
        return $this->project;
    }

    public function setProject(?Projects $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getSkills(): ?Skills
    {
        return $this->skills;
    }

    public function setSkills(?Skills $skills): static
    {
        $this->skills = $skills;

        return $this;
    }
}
