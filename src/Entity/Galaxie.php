<?php

namespace App\Entity;

use App\Repository\GalaxieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GalaxieRepository::class)]
class Galaxie
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

    #[ORM\Column(type: 'integer')]
    private $Diametre;

    #[ORM\ManyToOne(targetEntity: GroupeGalaxies::class, inversedBy: 'galaxies')]
    #[ORM\JoinColumn(nullable: false)]
    private $GroupeGalaxies;

    #[ORM\OneToMany(mappedBy: 'Galaxie', targetEntity: BrasSpiral::class, orphanRemoval: true)]
    private $brasSpirals;

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

    public function getDiametre(): ?int
    {
        return $this->Diametre;
    }

    public function setDiametre(int $Diametre): self
    {
        $this->Diametre = $Diametre;

        return $this;
    }

    public function __construct($pNom, $pTaille, $pDescription, $pDiametre, $pGroupeGalaxies)
    {
        $this->Nom=$pNom;
        $this->Taille=$pTaille;
        $this->Description=$pDescription;
        $this->Diametre=$pDiametre;
        $this->GroupeGalaxies=$pGroupeGalaxies;
        $this->brasSpirals = new ArrayCollection();
    }

    public function getGroupeGalaxies(): ?GroupeGalaxies
    {
        return $this->GroupeGalaxies;
    }

    public function setGroupeGalaxie(?GroupeGalaxies $GroupeGalaxies): self
    {
        $this->GroupeGalaxies = $GroupeGalaxies;

        return $this;
    }

    /**
     * @return Collection|BrasSpiral[]
     */
    public function getBrasSpirals(): Collection
    {
        return $this->brasSpirals;
    }

    public function addBrasSpiral(BrasSpiral $brasSpiral): self
    {
        if (!$this->brasSpirals->contains($brasSpiral)) {
            $this->brasSpirals[] = $brasSpiral;
            $brasSpiral->setGalaxie($this);
        }

        return $this;
    }

    public function removeBrasSpiral(BrasSpiral $brasSpiral): self
    {
        if ($this->brasSpirals->removeElement($brasSpiral)) {
            // set the owning side to null (unless already changed)
            if ($brasSpiral->getGalaxie() === $this) {
                $brasSpiral->setGalaxie(null);
            }
        }

        return $this;
    }
}
