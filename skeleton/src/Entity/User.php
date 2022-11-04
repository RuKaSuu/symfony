<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{

//    protected $matcher;
//    protected $controllerResolver;
//    protected $argumentResolver;
//
    //Create a function __construct


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $Surname = null;

    #[ORM\Column]
    private ?int $Age = null;

    #[ORM\Column(length: 255)]
    private ?string $Address = null;

    #[ORM\Column(length: 50)]
    private ?string $levels = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $Skills = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getLevels(): ?string
    {
        return $this->levels;
    }

    public function setLevels(string $levels): self
    {
        $this->levels = $levels;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getSkills(): array
    {
        return $this->Skills;
    }

    public function setSkills(?array $Skills): self
    {
        $this->Skills = $Skills;

        return $this;
    }

}
