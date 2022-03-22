<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
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
     * min=2,
     * minMessage="Votre nom doit contenir plus de 2 lettre")
     * @Assert\Regex(
     * pattern="/^[A-Za-z]+$/",
     * 
     * message="Votre nom ne peut pas contenir un chiffre")
     */
    private $nomClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min=2,
     * minMessage="Votre prénom doit contenir plus de 2 lettre")
     * @Assert\Regex(
     * pattern="/^[A-Za-z]+$/",
     * 
     * message="Votre prénom ne peut pas contenir un chiffre")
     */
    private $prenomClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min=15)
     * 
     */
    private $adressClient;

    /**
     * @ORM\Column(type="integer", length=10)
     * @Assert\Length(
     * min=5,
     * max=5,
     * exactMessage="Veuillez saisir un bon code de 5 chiffres!")
     */
    private $cpClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min=2,
     * minMessage="Le nom de ville doit contenir au moins de 2 lettre!")
     * @Assert\Regex(
     * pattern="/^[0-9A-Za-z]+$/",
     * 
     * message="Le nom de ville ne peut pas contenir une lettre spéciale!")
     */
    private $villeClient;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     * min=10,
     * max=10,
     * exactMessage="Numéro de téléphone ne contient que 10 chiffres!")
     */
    private $contactClient;

    /**
     * @ORM\Column(type="string", length=3)
     * @Assert\IdenticalTo("PRO","PAR")
     */
    private $typeClient;

    /**
     * @ORM\OneToMany(targetEntity=Commandes::class, mappedBy="client")
     */
    private $commandes;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }
    public function __toString()
    {
     return $this->nomClient;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getAdressClient(): ?string
    {
        return $this->adressClient;
    }

    public function setAdressClient(string $adressClient): self
    {
        $this->adressClient = $adressClient;

        return $this;
    }

    public function getCpClient(): ?int
    {
        return $this->cpClient;
    }

    public function setCpClient(int $cpClient): self
    {
        $this->cpClient = $cpClient;

        return $this;
    }

    public function getVilleClient(): ?string
    {
        return $this->villeClient;
    }

    public function setVilleClient(string $villeClient): self
    {
        $this->villeClient = $villeClient;

        return $this;
    }

    public function getContactClient(): ?int
    {
        return $this->contactClient;
    }

    public function setContactClient(int $contactClient): self
    {
        $this->contactClient = $contactClient;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->typeClient;
    }

    public function setTypeClient(string $typeClient): self
    {
        $this->typeClient = $typeClient;

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
