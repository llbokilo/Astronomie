<?php

namespace App\Entity;

use App\Repository\SatelliteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SatelliteRepository::class)]
class Satellite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $Nom;

    #[ORM\Column(type: 'integer')]
    private $Diametre;

    #[ORM\Column(type: 'float')]
    private $Gravite;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: Planete::class, inversedBy: 'satellites')]
    #[ORM\JoinColumn(nullable: false)]
    private $Planete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDiametre(): ?int
    {
        return $this->Diametre;
    }

    public function setDiametre(int $Diametre): self
    {
        $this->Diametre = $Diametre;

        return $this;
    }

    public function getGravite(): ?float
    {
        return $this->Gravite;
    }

    public function setGravite(float $Gravite): self
    {
        $this->Gravite = $Gravite;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function __construct($pNom, $pDiametre, $pGravite, $pDescription)
    {
        $this->Nom=$pNom;
        $this->Diametre=$pDiametre;
        $this->Gravite=$pGravite;
        $this->Description=$pDescription;
    }

    public function getPlanete(): ?Planete
    {
        return $this->Planete;
    }

    public function setPlanete(?Planete $Planete): self
    {
        $this->Planete = $Planete;

        return $this;
    }
}
