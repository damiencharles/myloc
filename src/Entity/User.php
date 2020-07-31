<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;  


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *  fields={"email"},
 *  message="cet email est déjà utilisé"
 * )s
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\OneToMany(targetEntity=Bien::class, mappedBy="proprietaire")
     */
    private $biens_user;

    /**
     * @ORM\OneToMany(targetEntity=Pret::class, mappedBy="user")
     */
    private $pret_user;

    public function __construct()
    {
        $this->biens_user = new ArrayCollection();
        $this->pret_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function getUsername(): ?string
    {
        return $this->pseudo;
    }


    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return Collection|Bien[]
     */
    public function getBiensUser(): Collection
    {
        return $this->biens_user;
    }

    public function addBiensUser(Bien $biensUser): self
    {
        if (!$this->biens_user->contains($biensUser)) {
            $this->biens_user[] = $biensUser;
            $biensUser->setProprietaire($this);
        }

        return $this;
    }

    public function removeBiensUser(Bien $biensUser): self
    {
        if ($this->biens_user->contains($biensUser)) {
            $this->biens_user->removeElement($biensUser);
            // set the owning side to null (unless already changed)
            if ($biensUser->getProprietaire() === $this) {
                $biensUser->setProprietaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pret[]
     */
    public function getPretUser(): Collection
    {
        return $this->pret_user;
    }

    public function addPretUser(Pret $pretUser): self
    {
        if (!$this->pret_user->contains($pretUser)) {
            $this->pret_user[] = $pretUser;
            $pretUser->setUser($this);
        }

        return $this;
    }

    public function removePretUser(Pret $pretUser): self
    {
        if ($this->pret_user->contains($pretUser)) {
            $this->pret_user->removeElement($pretUser);
            // set the owning side to null (unless already changed)
            if ($pretUser->getUser() === $this) {
                $pretUser->setUser(null);
            }
        }

        return $this;
    }

    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function __toString()
    {
        return $this->pseudo;
    }
}
