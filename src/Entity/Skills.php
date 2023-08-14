<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillsRepository::class)]
class Skills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 60)]
    private ?string $level = null;

    #[ORM\OneToMany(mappedBy: 'skills', targetEntity: ProjectSkills::class)]
    private Collection $projectSkills;

    public function __construct()
    {
        $this->projectSkills = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, ProjectSkillsPictures>
     */
    public function getProjectSkills(): Collection
    {
        return $this->projectSkills;
    }

    public function addProjectSkills(ProjectSkills $projectSkillsPicture): static
    {
        if (!$this->projectSkills->contains($projectSkillsPicture)) {
            $this->projectSkills->add($projectSkillsPicture);
            $projectSkillsPicture->setSkills($this);
        }

        return $this;
    }

    public function removeProjectSkills(ProjectSkills $projectSkillsPicture): static
    {
        if ($this->projectSkills->removeElement($projectSkillsPicture)) {
            // set the owning side to null (unless already changed)
            if ($projectSkillsPicture->getSkills() === $this) {
                $projectSkillsPicture->setSkills(null);
            }
        }

        return $this;
    }
}
