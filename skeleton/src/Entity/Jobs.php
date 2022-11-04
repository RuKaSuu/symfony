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
    private ?\DateTimeInterface $postDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $degree = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $skills = [];

    #[ORM\ManyToOne(inversedBy: 'jobs')]
    private ?Company $company = null;
//
//    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
//    private array $skills = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->postDate;
    }

    public function setPostDate(\DateTimeInterface $postDate): self
    {
        $this->postDate = $postDate;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(?string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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
