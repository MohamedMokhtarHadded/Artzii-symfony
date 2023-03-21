<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Basket
 *
 * @ORM\Table(name="basket", indexes={@ORM\Index(name="id_article", columns={"id_article"}), @ORM\Index(name="id_client", columns={"id_client"})})
 * @ORM\Entity
 */
class Basket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idClient;

    /**
     * @var int
     *
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idArticle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateAjout = 'CURRENT_TIMESTAMP';

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function getIdArticle(): ?int
    {
        return $this->idArticle;
    }
    public function setIdClient(int $idClient): self
{
    $this->idClient = $idClient;
    return $this;
}

public function setIdArticle(int $idArticle): self
{
    $this->idArticle = $idArticle;
    return $this;
}

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }


}
