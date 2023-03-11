<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BINARY, nullable: true)]
    private $mdp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp($mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }
}
