<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="tags")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity=Recit::class, mappedBy="tags")
     */
    private $recits;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->recits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $article->addTag($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeTag($this);
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
            $recit->addTag($this);
        }

        return $this;
    }

    public function removeRecit(Recit $recit): self
    {
        if ($this->recits->removeElement($recit)) {
            $recit->removeTag($this);
        }

        return $this;
    }
}
