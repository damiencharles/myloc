<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=BienRepository::class)
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="biens_categorie")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="biens_user")
     */
    private $proprietaire;

    /**
     * @ORM\OneToMany(targetEntity=Pret::class, mappedBy="bien_pret")
     */
    private $pret_bien;

    public function __construct()
    {
        $this->pret_bien = new ArrayCollection();
    }

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

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage(?string $image): self
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

    public function getproprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setproprietaire(?User $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }


     public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function __toString()
    {
        return $this->nom_bien;
    }

    /**
     * @return Collection|Pret[]
     */
    public function getPretBien(): Collection
    {
        return $this->pret_bien;
    }

    public function addPretBien(Pret $pretBien): self
    {
        if (!$this->pret_bien->contains($pretBien)) {
            $this->pret_bien[] = $pretBien;
            $pretBien->setBienPret($this);
        }

        return $this;
    }

    public function removePretBien(Pret $pretBien): self
    {
        if ($this->pret_bien->contains($pretBien)) {
            $this->pret_bien->removeElement($pretBien);
            // set the owning side to null (unless already changed)
            if ($pretBien->getBienPret() === $this) {
                $pretBien->setBienPret(null);
            }
        }

        return $this;
    }
   
}