<?php

namespace App\Entity;

use App\Repository\FournisseursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseursRepository::class)
 */
class Fournisseurs
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
    private $nomFour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomFour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressFour;

    /**
     * @ORM\Column(type="integer")
     */
    private $cpFour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeFour;

    /**
     * @ORM\Column(type="integer")
     */
    private $contactFour;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $typeFour;

    /**
     * @ORM\ManyToMany(targetEntity=Produits::class, mappedBy="Fournisseurs")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }
    public function __toString()
    {
     return $this->nomFour;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFour(): ?string
    {
        return $this->nomFour;
    }

    public function setNomFour(string $nomFour): self
    {
        $this->nomFour = $nomFour;

        return $this;
    }

    public function getPrenomFour(): ?string
    {
        return $this->prenomFour;
    }

    public function setPrenomFour(string $prenomFour): self
    {
        $this->prenomFour = $prenomFour;

        return $this;
    }

    public function getAdressFour(): ?string
    {
        return $this->adressFour;
    }

    public function setAdressFour(string $adressFour): self
    {
        $this->adressFour = $adressFour;

        return $this;
    }

    public function getCpFour(): ?int
    {
        return $this->cpFour;
    }

    public function setCpFour(int $cpFour): self
    {
        $this->cpFour = $cpFour;

        return $this;
    }

    public function getVilleFour(): ?string
    {
        return $this->villeFour;
    }

    public function setVilleFour(string $villeFour): self
    {
        $this->villeFour = $villeFour;

        return $this;
    }

    public function getContactFour(): ?int
    {
        return $this->contactFour;
    }

    public function setContactFour(int $contactFour): self
    {
        $this->contactFour = $contactFour;

        return $this;
    }

    public function getTypeFour(): ?string
    {
        return $this->typeFour;
    }

    public function setTypeFour(string $typeFour): self
    {
        $this->typeFour = $typeFour;

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
            $produit->addFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeFournisseur($this);
        }

        return $this;
    }
}
