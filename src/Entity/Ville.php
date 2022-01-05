<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=600, nullable=true)
     */
    private $population;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="ville")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity=Recit::class, mappedBy="ville")
     */
    private $recits;

    /**
     * @ORM\Column(type="string", length=600, nullable=true)
     */
    private $intro;

    /**
     * @ORM\Column(type="string", length=1200, nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->recits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }

    public function setPopulation(?string $population): self
    {
        $this->population = $population;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addVille($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeVille($this);
        }

        return $this;
    }

    /**
     * @return Collection|Recit[]
     */
    public function getRecits(): Collection
    {
        return $this->recits;
    }

    public function addRecit(Recit $recit): self
    {
        if (!$this->recits->contains($recit)) {
            $this->recits[] = $recit;
            $recit->addVille($this);
        }

        return $this;
    }

    public function removeRecit(Recit $recit): self
    {
        if ($this->recits->removeElement($recit)) {
            $recit->removeVille($this);
        }

        return $this;
    }

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(?string $intro): self
    {
        $this->intro = $intro;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function __toString()
    {
     return $this->nom;
    }
}

