<?php

namespace App\Entity;

use App\Repository\EtoileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtoileRepository::class)]
class Etoile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $Nom;

    #[ORM\Column(type: 'integer')]
    private $Diametre;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $Description;

    #[ORM\Column(type: 'float')]
    private $Gravite;

    #[ORM\ManyToOne(targetEntity: SystemePlanetaire::class, inversedBy: 'etoiles')]
    #[ORM\JoinColumn(nullable: false)]
    private $SystemePlanetaire;

    #[ORM\OneToMany(mappedBy: 'Etoile', targetEntity: Planete::class, orphanRemoval: true)]
    private $planetes;

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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

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

    public function __construct($pNom, $pDiametre, $pGravite, $pDescription)
    {
        $this->Nom=$pNom;
        $this->Diametre=$pDiametre;
        $this->Gravite=$pGravite;
        $this->Description=$pDescription;
        $this->planetes = new ArrayCollection();
    }

    public function getSystemePlanetaire(): ?SystemePlanetaire
    {
        return $this->SystemePlanetaire;
    }

    public function setSystemePlanetaire(?SystemePlanetaire $SystemePlanetaire): self
    {
        $this->SystemePlanetaire = $SystemePlanetaire;

        return $this;
    }

    /**
     * @return Collection|Planete[]
     */
    public function getPlanetes(): Collection
    {
        return $this->planetes;
    }

    public function addPlanete(Planete $planete): self
    {
        if (!$this->planetes->contains($planete)) {
            $this->planetes[] = $planete;
            $planete->setEtoile($this);
        }

        return $this;
    }

    public function removePlanete(Planete $planete): self
    {
        if ($this->planetes->removeElement($planete)) {
            // set the owning side to null (unless already changed)
            if ($planete->getEtoile() === $this) {
                $planete->setEtoile(null);
            }
        }

        return $this;
    }
}
