<?php

namespace App\Entity;

use App\Repository\GroupeGalaxiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeGalaxiesRepository::class)]
class GroupeGalaxies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $Nom;

    #[ORM\Column(type: 'float')]
    private $Taille;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: Superamas::class, inversedBy: 'groupeGalaxies')]
    #[ORM\JoinColumn(nullable: false)]
    private $Superamas;

    #[ORM\OneToMany(mappedBy: 'GroupeGalaxie', targetEntity: Galaxie::class, orphanRemoval: true)]
    private $galaxies;

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

    public function getTaille(): ?float
    {
        return $this->Taille;
    }

    public function setTaille(float $Taille): self
    {
        $this->Taille = $Taille;

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

    public function __construct($pNom, $pTaille, $pDescription)
    {
        $this->Nom=$pNom;
        $this->Taille=$pTaille;
        $this->Description=$pDescription;
        $this->galaxies = new ArrayCollection();
    }

    public function getSuperamas(): ?Superamas
    {
        return $this->Superamas;
    }

    public function setSuperamas(?Superamas $Superamas): self
    {
        $this->Superamas = $Superamas;

        return $this;
    }

    /**
     * @return Collection|Galaxie[]
     */
    public function getGalaxies(): Collection
    {
        return $this->galaxies;
    }

    public function addGalaxy(Galaxie $galaxy): self
    {
        if (!$this->galaxies->contains($galaxy)) {
            $this->galaxies[] = $galaxy;
            $galaxy->setGroupeGalaxie($this);
        }

        return $this;
    }

    public function removeGalaxy(Galaxie $galaxy): self
    {
        if ($this->galaxies->removeElement($galaxy)) {
            // set the owning side to null (unless already changed)
            if ($galaxy->getGroupeGalaxie() === $this) {
                $galaxy->setGroupeGalaxie(null);
            }
        }

        return $this;
    }
}
