<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: '`utilisateur`')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['emailU'], message: 'There is already an account with this emailU')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idU", type: "integer", nullable: false)]
    private $idU;

    #[ORM\Column(name: "nomU", type: "string", length: 20, nullable: false)]
    private $nomU;

    #[ORM\Column(name: "prenomU", type: "string", length: 20, nullable: false)]
    private $prenomU;

    #[ORM\Column(name: "emailU", type: "string", length: 20, nullable: false, unique: true)]
    private $emailU;

    #[ORM\Column(name: "mdpU",type: Types::BINARY, length: 100, nullable: true)]
    private $mdpU ;

    #[ORM\Column(name: "roleU", type: "string", length: 20, nullable: false)]
    private $roleU;

    #[ORM\Column(name: "adresse", type: "string", length: 20, nullable: false)]
    private $adresse;

    public function getIdU(): ?int
    {
        return $this->idU;
    }

    public function getNomU(): ?string
    {
        return $this->nomU;
    }

    public function setNomU(string $nomU): self
    {
        $this->nomU = $nomU;

        return $this;
    }

    public function getPrenomU(): ?string
    {
        return $this->prenomU;
    }

    public function setPrenomU(string $prenomU): self
    {
        $this->prenomU = $prenomU;

        return $this;
    }

    public function getEmailU(): ?string
    {
        return $this->emailU;
    }

    public function setEmailU(string $emailU): self
    {
        $this->emailU = $emailU;

        return $this;
    }

    public function getMdpU(): ?string
    {
        return $this->mdpU;
    }

    public function setMdpU(string $mdpU): self
    {
        $this->mdpU = $mdpU;

        return $this;
    }

    public function getRoleU(): ?string
    {
        return $this->roleU;
    }

    public function setRoleU(string $roleU): self
    {
        $this->roleU = $roleU;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->emailU;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->emailU;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return [$this->roleU];
    }

    public function setRoles(array $roles): self
    {
    $this->roleU = $roles[0];
    return $this;
}

/**
 * @see PasswordAuthenticatedUserInterface
 */
public function getPassword(): string
{
    return $this->mdpU;
}

public function setPassword(string $password): self
{
    $this->mdpU = $password;

    return $this;
}

/**
 * Returning a salt is only needed, if you are not using a modern
 * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
 *
 * @see UserInterface
 */
public function getSalt(): ?string
{
    return null;
}

/**
 * @see UserInterface
 */
public function eraseCredentials()
{
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
}

}