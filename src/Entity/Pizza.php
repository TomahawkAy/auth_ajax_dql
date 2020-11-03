<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PizzaRepository::class)
 */
class Pizza
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $slices;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pizzas")
     */
    private $eatenBy;

    /**
     * @ORM\ManyToOne(targetEntity=Livreur::class, inversedBy="pizzas")
     */
    private $livreur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlices(): ?int
    {
        return $this->slices;
    }

    public function setSlices(int $slices): self
    {
        $this->slices = $slices;

        return $this;
    }

    public function getEatenBy(): ?User
    {
        return $this->eatenBy;
    }

    public function setEatenBy(?User $eatenBy): self
    {
        $this->eatenBy = $eatenBy;

        return $this;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        $this->livreur = $livreur;

        return $this;
    }
}
