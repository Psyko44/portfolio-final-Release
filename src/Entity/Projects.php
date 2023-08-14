<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\ProjectSkills;
use App\Entity\ProjectPicture;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectsRepository::class)]
class Projects
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectSkills::class)]
    private Collection $projectSkills;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectPicture::class)]
    private Collection $projectPictures;

    public function __construct()
    {
        $this->projectSkills = new ArrayCollection();
        $this->projectPictures = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection<int, ProjectSkillsPictures>
     */
    public function getProjectSkills(): Collection
    {
        return $this->projectSkills;
    }

    public function addProjectSkills(ProjectSkills $projectSkills): static
    {
        if (!$this->projectSkills->contains($projectSkills)) {
            $this->projectSkills->add($projectSkills);
            $projectSkills->setProject($this);
        }

        return $this;
    }

    public function removeProjectSkills(ProjectSkills $projectSkills): static
    {
        if ($this->projectSkills->removeElement($projectSkills)) {
            // set the owning side to null (unless already changed)
            if ($projectSkills->getProject() === $this) {
                $projectSkills->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProjectPicture>
     */
    public function getProjectPictures(): Collection
    {
        return $this->projectPictures;
    }

    public function addProjectPicture(ProjectPicture $projectPicture): static
    {
        if (!$this->projectPictures->contains($projectPicture)) {
            $this->projectPictures->add($projectPicture);
            $projectPicture->setProject($this);
        }

        return $this;
    }

    public function removeProjectPicture(ProjectPicture $projectPicture): static
    {
        if ($this->projectPictures->removeElement($projectPicture)) {
            // set the owning side to null (unless already changed)
            if ($projectPicture->getProject() === $this) {
                $projectPicture->setProject(null);
            }
        }

        return $this;
    }
}
