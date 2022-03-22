<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateComm;

    /**
     * @ORM\Column(type="float")
     */
    private $montantComm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressLivr;

    /**
     * @ORM\Column(type="integer")
     */
    private $cpLivr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeLivr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressFact;

    /**
     * @ORM\Column(type="integer")
     */
    private $cpFact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeFact;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;




    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $tauxTva;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typePaiement;

    /**
     * @ORM\OneToMany(targetEntity=LigneCommande::class, mappedBy="commande")
     */
    private $ligneCommandes;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateComm(): ?\DateTimeInterface
    {
        return $this->dateComm;
    }

    public function setDateComm(\DateTimeInterface $dateComm): self
    {
        $this->dateComm = $dateComm;

        return $this;
    }

    public function getMontantComm(): ?float
    {
        return $this->montantComm;
    }

    public function setMontantComm(float $montantComm): self
    {
        $this->montantComm = $montantComm;

        return $this;
    }

    public function getAdressLivr(): ?string
    {
        return $this->adressLivr;
    }

    public function setAdressLivr(string $adressLivr): self
    {
        $this->adressLivr = $adressLivr;

        return $this;
    }

    public function getCpLivr(): ?int
    {
        return $this->cpLivr;
    }

    public function setCpLivr(int $cpLivr): self
    {
        $this->cpLivr = $cpLivr;

        return $this;
    }

    public function getVilleLivr(): ?string
    {
        return $this->villeLivr;
    }

    public function setVilleLivr(string $villeLivr): self
    {
        $this->villeLivr = $villeLivr;

        return $this;
    }

    public function getAdressFact(): ?string
    {
        return $this->adressFact;
    }

    public function setAdressFact(string $adressFact): self
    {
        $this->adressFact = $adressFact;

        return $this;
    }

    public function getCpFact(): ?int
    {
        return $this->cpFact;
    }

    public function setCpFact(int $cpFact): self
    {
        $this->cpFact = $cpFact;

        return $this;
    }

    public function getVilleFact(): ?string
    {
        return $this->villeFact;
    }

    public function setVilleFact(string $villeFact): self
    {
        $this->villeFact = $villeFact;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

   

    public function getTauxTva(): ?string
    {
        return $this->tauxTva;
    }

    public function setTauxTva(string $tauxTva): self
    {
        $this->tauxTva = $tauxTva;

        return $this;
    }

    public function getTypePaiement(): ?string
    {
        return $this->typePaiement;
    }

    public function setTypePaiement(string $typePaiement): self
    {
        $this->typePaiement = $typePaiement;

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
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

        return $this;
    }
}
