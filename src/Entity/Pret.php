<?php

namespace App\Entity;

use App\Repository\PretRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PretRepository::class)
 */
class Pret
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Bien::class, inversedBy="pret_bien", cascade={"persist", "remove"})
     */
    private $bien_pret;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pret_user")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="integer")
     */
    private $points_pret;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBienPret(): ?Bien
    {
        return $this->bien_pret;
    }

    public function setBienPret(?Bien $bien_pret): self
    {
        $this->bien_pret = $bien_pret;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getPointsPret(): ?int
    {
        return $this->points_pret;
    }

    public function setPointsPret(int $points_pret): self
    {
        $this->points_pret = $points_pret;

        return $this;
    }
}
