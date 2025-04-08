<?php
// src/Entity/Article.php

namespace App\Entity;

use App\Entity\Ligne;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'string')]
    private ?string $id = null;

    #[ORM\Column(length: 100)]
    private ?string $designation = null;

    #[ORM\Column(type: 'float')]
    private ?float $prix = null;

    #[ORM\Column(length: 100)]
    private ?string $categorie = null;

    /**
     * @var Collection<int, Ligne>
     */
    #[ORM\OneToMany(targetEntity: Ligne::class, mappedBy: 'article')]
    private Collection $lignes;

    #[ORM\ManyToOne(targetEntity: ListedesCommandes::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(name: 'listedes_commandes_id', referencedColumnName: 'id_comm', nullable: false)]
    private ?ListedesCommandes $listedesCommandes = null;

    public function __construct()
    {
        $this->lignes = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;
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

    public function getQuantiteVendue(): int
    {
        $quantite_vendue = 0;
        foreach ($this->lignes as $ligne) {
            $quantite_vendue += $ligne->getQuantite();
        }
        return $quantite_vendue;
    }

    /**
     * @return Collection<int, Ligne>
     */
    public function getLignes(): Collection
    {
        return $this->lignes;
    }

    public function addLigne(Ligne $ligne): static
    {
        if (!$this->lignes->contains($ligne)) {
            $this->lignes->add($ligne);
            $ligne->setArticle($this);
        }
        return $this;
    }

    public function removeLigne(Ligne $ligne): static
    {
        if ($this->lignes->removeElement($ligne) && $ligne->getArticle() === $this) {
            $ligne->setArticle(null);
        }
        return $this;
    }

    public function getListedesCommandes(): ?ListedesCommandes
    {
        return $this->listedesCommandes;
    }

    public function setListedesCommandes(?ListedesCommandes $listedesCommandes): static
    {
        $this->listedesCommandes = $listedesCommandes;
        return $this;
    }
}
