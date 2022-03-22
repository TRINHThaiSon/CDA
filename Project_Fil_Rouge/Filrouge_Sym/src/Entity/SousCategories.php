<?php

namespace App\Entity;

use App\Repository\SousCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousCategoriesRepository::class)
 */
class SousCategories
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
    private $numSouscat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomSouscat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageSouscat;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="sousCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="souscategorie")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }
    public function __toString()
    {
     return $this->nomSouscat;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSouscat(): ?string
    {
        return $this->numSouscat;
    }

    public function setNumSouscat(string $numSouscat): self
    {
        $this->numSouscat = $numSouscat;

        return $this;
    }

    public function getNomSouscat(): ?string
    {
        return $this->nomSouscat;
    }

    public function setNomSouscat(string $nomSouscat): self
    {
        $this->nomSouscat = $nomSouscat;

        return $this;
    }

    public function getImageSouscat(): ?string
    {
        return $this->imageSouscat;
    }

    public function setImageSouscat(string $imageSouscat): self
    {
        $this->imageSouscat = $imageSouscat;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setSouscategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getSouscategorie() === $this) {
                $produit->setSouscategorie(null);
            }
        }

        return $this;
    }
}
