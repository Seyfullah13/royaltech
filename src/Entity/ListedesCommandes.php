<?php
// src/Entity/ListedesCommandes.php

namespace App\Entity;

use App\Entity\Article;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use App\Repository\ListedesCommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


#[ORM\Entity(repositoryClass: ListedesCommandesRepository::class)]
class ListedesCommandes
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $Id_comm = null;

    #[ORM\Column]
    private ?int $id_client = null;

    #[ORM\Column(length: 10)]
    private ?string $Civilite = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 50)]
    private ?string $Ville = null;

    private ?string $invoiceLink = null;

    /**
     * @var Collection<int, Article>
     */
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'listedesCommandes')]
    private Collection $articles;



    public function __construct(private RouteCollection $routes, private RequestContext $context)
    {
        $this->articles = new ArrayCollection();
        $this->routes = $routes;
        $this->context = $context;
    }

    public function getIdComm(): ?int
    {
        return $this->Id_comm;
    }

    public function setIdComm(int $Id_comm): static
    {
        $this->Id_comm = $Id_comm;
        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function setIdClient(int $id_client): static
    {
        $this->id_client = $id_client;
        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->Civilite;
    }

    public function setCivilite(string $Civilite): static
    {
        $this->Civilite = $Civilite;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;
        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;
        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setListedesCommandes($this);
        }
        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article) && $article->getListedesCommandes() === $this) {
            $article->setListedesCommandes(null);
        }
        return $this;
    }

    public function getInvoiceLink(): ?string
    {
        // $routes = new RouteCollection();
        // $context = new RequestContext();
        $generator = new UrlGenerator($this->routes, $this->context);
        return $generator->generate("generate_invoice", ["id" => $this->getIdComm()], UrlGeneratorInterface::ABSOLUTE_URL);

        // return $this->invoiceLink;
    }
    public function setInvoiceLink(string $invoiceLink): static
    {
        $this->invoiceLink = $invoiceLink;
        return $this;
    }
}
