<?php

namespace App\Entity;

use App\Repository\PlaneteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaneteRepository::class)]
class Planete
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

    #[ORM\Column(type: 'string', length: 50)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: Etoile::class, inversedBy: 'planetes')]
    #[ORM\JoinColumn(nullable: false)]
    private $Etoile;

    #[ORM\OneToMany(mappedBy: 'Planete', targetEntity: Satellite::class, orphanRemoval: true)]
    private $satellites;

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

    public function setDescription(string $Description): self
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
        $this->satellites = new ArrayCollection();
    }

    public function getEtoile(): ?Etoile
    {
        return $this->Etoile;
    }

    public function setEtoile(?Etoile $Etoile): self
    {
        $this->Etoile = $Etoile;

        return $this;
    }

    /**
     * @return Collection|Satellite[]
     */
    public function getSatellites(): Collection
    {
        return $this->satellites;
    }

    public function addSatellite(Satellite $satellite): self
    {
        if (!$this->satellites->contains($satellite)) {
            $this->satellites[] = $satellite;
            $satellite->setPlanete($this);
        }

        return $this;
    }

    public function removeSatellite(Satellite $satellite): self
    {
        if ($this->satellites->removeElement($satellite)) {
            // set the owning side to null (unless already changed)
            if ($satellite->getPlanete() === $this) {
                $satellite->setPlanete(null);
            }
        }

        return $this;
    }
}
