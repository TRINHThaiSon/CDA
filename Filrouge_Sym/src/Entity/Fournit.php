<?php

namespace App\Entity;

use App\Repository\FournitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournitRepository::class)
 */
class Fournit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prixUnitFou;

    /**
     * @ORM\Column(type="float")
     */
    private $tauxTVAfou;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteFou;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFou;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixUnitFou(): ?float
    {
        return $this->prixUnitFou;
    }

    public function setPrixUnitFou(float $prixUnitFou): self
    {
        $this->prixUnitFou = $prixUnitFou;

        return $this;
    }

    public function getTauxTVAfou(): ?float
    {
        return $this->tauxTVAfou;
    }

    public function setTauxTVAfou(float $tauxTVAfou): self
    {
        $this->tauxTVAfou = $tauxTVAfou;

        return $this;
    }

    public function getQteFou(): ?int
    {
        return $this->qteFou;
    }

    public function setQteFou(int $qteFou): self
    {
        $this->qteFou = $qteFou;

        return $this;
    }

    public function getDateFou(): ?\DateTimeInterface
    {
        return $this->dateFou;
    }

    public function setDateFou(\DateTimeInterface $dateFou): self
    {
        $this->dateFou = $dateFou;

        return $this;
    }
}
