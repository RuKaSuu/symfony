<?php

namespace App\Entity;

use App\Repository\JobsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobsRepository::class)]
class Jobs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $PostDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Degree = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(length: 255)]
    private ?string $Location = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $skills = [];

    #[ORM\ManyToOne(inversedBy: 'jobs')]
    private ?Company $company = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $skills = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->PostDate;
    }

    public function setPostDate(\DateTimeInterface $PostDate): self
    {
        $this->PostDate = $PostDate;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->Degree;
    }

    public function setDegree(?string $Degree): self
    {
        $this->Degree = $Degree;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills(?array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getCompany(): ?company
    {
        return $this->company;
    }

    public function setCompany(?company $company): self
    {
        $this->company = $company;

        return $this;
    }

}
