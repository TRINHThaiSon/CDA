<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min=10,
     * minMessage="Nom de produit doit contenir 10 lettres au minimum")
     */
    private $libelleCourteArticle;

    /**
     * @ORM\Column(type="string", length=66255, nullable=true)
     * @Assert\Length(
     * min=10,
     * minMessage="Description doit contenir 10 lettres au minimum")
     */
    private $libelleLongArticle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageArticle;

    /**
     * @ORM\Column(type="float")
     */
    private $prixunitArticle;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreStkArticle;

    /**
     * @ORM\ManyToOne(targetEntity=SousCategories::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $souscategorie;

    /**
     * @ORM\ManyToMany(targetEntity=Fournisseurs::class, inversedBy="produits")
     */
    private $Fournisseurs;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommande::class, mappedBy="produit")
     */
    private $ligneCommandes;



    public function __construct()
    {
        $this->Fournisseurs = new ArrayCollection();
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getLibelleCourteArticle(): ?string
    {
        return $this->libelleCourteArticle;
    }

    public function setLibelleCourteArticle(string $libelleCourteArticle): self
    {
        $this->libelleCourteArticle = $libelleCourteArticle;

        return $this;
    }

    public function getLibelleLongArticle(): ?string
    {
        return $this->libelleLongArticle;
    }

    public function setLibelleLongArticle(?string $libelleLongArticle): self
    {
        $this->libelleLongArticle = $libelleLongArticle;

        return $this;
    }

    public function getImageArticle(): ?string
    {
        return $this->imageArticle;
    }

    public function setImageArticle(string $imageArticle): self
    {
        $this->imageArticle = $imageArticle;

        return $this;
    }

    public function getPrixunitArticle(): ?float
    {
        return $this->prixunitArticle;
    }

    public function setPrixunitArticle(float $prixunitArticle): self
    {
        $this->prixunitArticle = $prixunitArticle;

        return $this;
    }

    public function getNombreStkArticle(): ?int
    {
        return $this->nombreStkArticle;
    }

    public function setNombreStkArticle(int $nombreStkArticle): self
    {
        $this->nombreStkArticle = $nombreStkArticle;

        return $this;
    }

    public function getSouscategorie(): ?SousCategories
    {
        return $this->souscategorie;
    }

    public function setSouscategorie(?SousCategories $souscategorie): self
    {
        $this->souscategorie = $souscategorie;

        return $this;
    }

    /**
     * @return Collection<int, Fournisseurs>
     */
    public function getFournisseurs(): Collection
    {
        return $this->Fournisseurs;
    }

    public function addFournisseur(Fournisseurs $fournisseur): self
    {
        if (!$this->Fournisseurs->contains($fournisseur)) {
            $this->Fournisseurs[] = $fournisseur;
        }

        return $this;
    }

    public function removeFournisseur(Fournisseurs $fournisseur): self
    {
        $this->Fournisseurs->removeElement($fournisseur);

        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

        return $this;
    }


   
}
