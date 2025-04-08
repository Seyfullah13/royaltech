<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LigneRepository;

#[ORM\Entity(repositoryClass: LigneRepository::class)]
class Ligne
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private ?string $article_id = null;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private ?string $commande_id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $quantite = null;

    #[ORM\Column(type: 'float')]
    private ?float $prix_unit = null;

    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'lignes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    public function getArticleId(): ?int
    {
        return $this->article_id;
    }

    public function getCommandeId(): ?string
    {
        return $this->commande_id;
    }

    public function setIdComm(string $commande_id): static
    {
        $this->commande_id = $commande_id;
        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getPrixUnit(): ?float
    {
        return $this->prix_unit;
    }

    public function setPrixUnit(float $prix_unit): static
    {
        $this->prix_unit = $prix_unit;
        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;
        return $this;
    }
}
