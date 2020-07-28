<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BienRepository::class)
 */
class Bien
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
    private $nom_bien;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="biens_categorie")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="biens_user")
     */
    private $propriétaire;

    /**
     * @ORM\OneToOne(targetEntity=Pret::class, mappedBy="bien_pret", cascade={"persist", "remove"})
     */
    private $pret_bien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBien(): ?string
    {
        return $this->nom_bien;
    }

    public function setNomBien(string $nom_bien): self
    {
        $this->nom_bien = $nom_bien;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPropriétaire(): ?User
    {
        return $this->propriétaire;
    }

    public function setPropriétaire(?User $propriétaire): self
    {
        $this->propriétaire = $propriétaire;

        return $this;
    }

    public function getPretBien(): ?Pret
    {
        return $this->pret_bien;
    }

    public function setPretBien(?Pret $pret_bien): self
    {
        $this->pret_bien = $pret_bien;

        // set (or unset) the owning side of the relation if necessary
        $newBien_pret = null === $pret_bien ? null : $this;
        if ($pret_bien->getBienPret() !== $newBien_pret) {
            $pret_bien->setBienPret($newBien_pret);
        }

        return $this;
    }
}
