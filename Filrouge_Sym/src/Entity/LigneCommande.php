<?php

namespace App\Entity;

use App\Repository\LigneCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigneCommandeRepository::class)
 */
class LigneCommande
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
    private $quantite;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $prixUnitaire;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class, inversedBy="ligneCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="ligneCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?string
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(string $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getCommande(): ?Commandes
    {
        return $this->commande;
    }

    public function setCommande(?Commandes $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
