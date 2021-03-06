<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use App\Repository\PretRepository;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pret_user")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     * @Assert\GreaterThanOrEqual("today")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     * @Assert\GreaterThanOrEqual(propertyPath="dateDebut")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="integer")
     */
    private $points_pret;

    /**
     * @ORM\ManyToOne(targetEntity=Bien::class, inversedBy="pret_bien")
     */
    private $bien_pret;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBienPret(): ?Bien
    {
        return $this->bien_pret;
    }

    public function setBienPret(?Bien $bien_pret): self
    {
        $this->bien_pret = $bien_pret;

        return $this;
    }

    public function isIncluded($date): bool
    {
        return $date >= $this->date_debut && $date <= $this->date_fin;
    }

}
