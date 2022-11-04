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

    #[ORM\Column(length: 255)]
    private ?string $jobName = null;

    #[ORM\Column(length: 255)]
    private ?string $jobCreator = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jobPostDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $jobDegree = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $jobDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $jobTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $jobLocation = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $skills = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobName(): ?string
    {
        return $this->jobName;
    }

    public function setJobName(string $jobName): self
    {
        $this->jobName = $jobName;

        return $this;
    }

    public function getJobCreator(): ?string
    {
        return $this->jobCreator;
    }

    public function setJobCreator(string $jobCreator): self
    {
        $this->jobCreator = $jobCreator;

        return $this;
    }

    public function getJobPostDate(): ?\DateTimeInterface
    {
        return $this->jobPostDate;
    }

    public function setJobPostDate(\DateTimeInterface $jobPostDate): self
    {
        $this->jobPostDate = $jobPostDate;

        return $this;
    }

    public function getJobDegree(): ?string
    {
        return $this->jobDegree;
    }

    public function setJobDegree(?string $jobDegree): self
    {
        $this->jobDegree = $jobDegree;

        return $this;
    }

    public function getJobDescription(): ?string
    {
        return $this->jobDescription;
    }

    public function setJobDescription(string $jobDescription): self
    {
        $this->jobDescription = $jobDescription;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getJobLocation(): ?string
    {
        return $this->jobLocation;
    }

    public function setJobLocation(string $jobLocation): self
    {
        $this->jobLocation = $jobLocation;

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
}
