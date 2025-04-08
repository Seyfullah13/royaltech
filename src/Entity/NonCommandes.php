<?php

namespace App\Entity;

use App\Repository\NonCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NonCommandesRepository::class)]
class NonCommandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Utilisation de la stratégie auto
    #[ORM\Column(type: 'integer')] // Définition de la colonne comme type entier
    private ?int $id = null; // Le type de $id doit être int

    #[ORM\Column(length: 50)]
    private ?string $designation = null;

    #[ORM\Column]
    private ?int $prix_unitaire = null;

    #[ORM\Column(length: 50)]
    private ?string $categorie = null;

    public function getId(): ?int // Retourne un int pour l'ID
    {
        return $this->id;
    }

    public function setId(int $id): static // Si tu veux définir l'ID manuellement, mais ce n'est pas courant pour un auto-incrément
    {
        $this->id = $id;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrixUnitaire(): ?int
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(int $prix_unitaire): static
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
