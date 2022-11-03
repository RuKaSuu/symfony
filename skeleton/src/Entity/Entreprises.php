<?php

namespace App\Entity;

use App\Repository\EntreprisesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntreprisesRepository::class)]
class Entreprises
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $compagnyName = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $compagnyPicture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(length: 500)]
    private ?string $websiteLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompagnyName(): ?string
    {
        return $this->compagnyName;
    }

    public function setCompagnyName(string $compagnyName): self
    {
        $this->compagnyName = $compagnyName;

        return $this;
    }

    public function getCompagnyPicture(): ?string
    {
        return $this->compagnyPicture;
    }

    public function setCompagnyPicture(?string $compagnyPicture): self
    {
        $this->compagnyPicture = $compagnyPicture;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getWebsiteLink(): ?string
    {
        return $this->websiteLink;
    }

    public function setWebsiteLink(string $websiteLink): self
    {
        $this->websiteLink = $websiteLink;

        return $this;
    }
}
