<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="CatId", columns={"catId"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @var int
     *
     * @ORM\Column(name="refA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refa;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idArtiste", type="integer", nullable=true)
     */
    private $idartiste;

    /**
     * @var string
     *
     * @ORM\Column(name="nomA", type="string", length=20, nullable=false)
     */
    private $noma;

    /**
     * @var string
     *
     * @ORM\Column(name="dimensionA", type="string", length=20, nullable=false)
     */
    private $dimensiona;

    /**
     * @var float
     *
     * @ORM\Column(name="prixA", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_url", type="string", length=400, nullable=true, options={"default"="../resources/eruro.png"})
     */
    private $imageUrl = '../resources/eruro.png';



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idClient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getRefa(): ?int
    {
        return $this->refa;
    }

    public function getIdartiste(): ?int
    {
        return $this->idartiste;
    }

    public function setIdartiste(?int $idartiste): self
    {
        $this->idartiste = $idartiste;

        return $this;
    }

    public function getNoma(): ?string
    {
        return $this->noma;
    }

    public function setNoma(string $noma): self
    {
        $this->noma = $noma;

        return $this;
    }

    public function getDimensiona(): ?string
    {
        return $this->dimensiona;
    }

    public function setDimensiona(string $dimensiona): self
    {
        $this->dimensiona = $dimensiona;

        return $this;
    }

    public function getPrixa(): ?float
    {
        return $this->prixa;
    }

    public function setPrixa(float $prixa): self
    {
        $this->prixa = $prixa;

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

    public function getCatid(): ?Categorie
    {
        return $this->catid;
    }

    public function setCatid(?Categorie $catid): self
    {
        $this->catid = $catid;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getIdClient(): Collection
    {
        return $this->idClient;
    }

    public function addIdClient(Utilisateur $idClient): self
    {
        if (!$this->idClient->contains($idClient)) {
            $this->idClient->add($idClient);
            $idClient->addIdArticle($this);
        }

        return $this;
    }

    public function removeIdClient(Utilisateur $idClient): self
    {
        if ($this->idClient->removeElement($idClient)) {
            $idClient->removeIdArticle($this);
        }

        return $this;
    }

}
