<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $idArtiste = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $nomA = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $dimensionA = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixA = null;

    #[ORM\Column(nullable: true)]
    private ?int $catId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdArtiste(): ?int
    {
        return $this->idArtiste;
    }

    public function setIdArtiste(?int $idArtiste): self
    {
        $this->idArtiste = $idArtiste;

        return $this;
    }

    public function getNomA(): ?string
    {
        return $this->nomA;
    }

    public function setNomA(?string $nomA): self
    {
        $this->nomA = $nomA;

        return $this;
    }

    public function getDimensionA(): ?string
    {
        return $this->dimensionA;
    }

    public function setDimensionA(?string $dimensionA): self
    {
        $this->dimensionA = $dimensionA;

        return $this;
    }

    public function getPrixA(): ?float
    {
        return $this->prixA;
    }

    public function setPrixA(?float $prixA): self
    {
        $this->prixA = $prixA;

        return $this;
    }

    public function getCatId(): ?int
    {
        return $this->catId;
    }

    public function setCatId(?int $catId): self
    {
        $this->catId = $catId;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
