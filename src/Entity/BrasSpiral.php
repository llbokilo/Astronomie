<?php

namespace App\Entity;

use App\Repository\BrasSpiralRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrasSpiralRepository::class)]
class BrasSpiral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $Nom;

    #[ORM\Column(type: 'integer')]
    private $Longueur;

    #[ORM\Column(type: 'integer')]
    private $Largeur;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: Galaxie::class, inversedBy: 'brasSpirals')]
    #[ORM\JoinColumn(nullable: false)]
    private $Galaxie;

    #[ORM\OneToMany(mappedBy: 'BrasSpiral', targetEntity: SystemePlanetaire::class, orphanRemoval: true)]
    private $systemePlanetaires;

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

    public function getLongueur(): ?int
    {
        return $this->Longueur;
    }

    public function setLongueur(int $Longueur): self
    {
        $this->Longueur = $Longueur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->Largeur;
    }

    public function setLargeur(int $Largeur): self
    {
        $this->Largeur = $Largeur;

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

    public function __construct($pNom, $pLongueur, $pLargeur, $pDescription, $pGalaxie)
    {
        $this->Nom=$pNom;
        $this->Longueur=$pLongueur;
        $this->Largeur=$pLargeur;
        $this->Description=$pDescription;
        $this->Galaxie=$pGalaxie;
        $this->systemePlanetaires = new ArrayCollection();
    }

    public function getGalaxie(): ?Galaxie
    {
        return $this->Galaxie;
    }

    public function setGalaxie(?Galaxie $Galaxie): self
    {
        $this->Galaxie = $Galaxie;

        return $this;
    }

    /**
     * @return Collection|SystemePlanetaire[]
     */
    public function getSystemePlanetaires(): Collection
    {
        return $this->systemePlanetaires;
    }

    public function addSystemePlanetaire(SystemePlanetaire $systemePlanetaire): self
    {
        if (!$this->systemePlanetaires->contains($systemePlanetaire)) {
            $this->systemePlanetaires[] = $systemePlanetaire;
            $systemePlanetaire->setBrasSpiral($this);
        }

        return $this;
    }

    public function removeSystemePlanetaire(SystemePlanetaire $systemePlanetaire): self
    {
        if ($this->systemePlanetaires->removeElement($systemePlanetaire)) {
            // set the owning side to null (unless already changed)
            if ($systemePlanetaire->getBrasSpiral() === $this) {
                $systemePlanetaire->setBrasSpiral(null);
            }
        }

        return $this;
    }
}
