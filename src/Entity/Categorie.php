<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $nom_categorie;

    /**
     * @ORM\OneToMany(targetEntity=Bien::class, mappedBy="categorie")
     */
    private $biens_categorie;

    public function __construct()
    {
        $this->biens_categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nom_categorie): self
    {
        $this->nom_categorie = $nom_categorie;

        return $this;
    }

    /**
     * @return Collection|Bien[]
     */
    public function getBiensCategorie(): Collection
    {
        return $this->biens_categorie;
    }

    public function addBiensCategorie(Bien $biensCategorie): self
    {
        if (!$this->biens_categorie->contains($biensCategorie)) {
            $this->biens_categorie[] = $biensCategorie;
            $biensCategorie->setCategorie($this);
        }

        return $this;
    }

    public function removeBiensCategorie(Bien $biensCategorie): self
    {
        if ($this->biens_categorie->contains($biensCategorie)) {
            $this->biens_categorie->removeElement($biensCategorie);
            // set the owning side to null (unless already changed)
            if ($biensCategorie->getCategorie() === $this) {
                $biensCategorie->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom_categorie;
    }
}
