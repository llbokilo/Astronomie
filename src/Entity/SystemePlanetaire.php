<?php

namespace App\Entity;

use App\Repository\SystemePlanetaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SystemePlanetaireRepository::class)]
class SystemePlanetaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $Nom;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: BrasSpiral::class, inversedBy: 'systemePlanetaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $BrasSpiral;

    #[ORM\OneToMany(mappedBy: 'SystemePlanetaire', targetEntity: Etoile::class, orphanRemoval: true)]
    private $etoiles;

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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function __construct($pNom, $pDescription)
    {
        $this->Nom=$pNom;
        $this->Description=$pDescription;
        $this->etoiles = new ArrayCollection();
    }

    public function getBrasSpiral(): ?BrasSpiral
    {
        return $this->BrasSpiral;
    }

    public function setBrasSpiral(?BrasSpiral $BrasSpiral): self
    {
        $this->BrasSpiral = $BrasSpiral;

        return $this;
    }

    /**
     * @return Collection|Etoile[]
     */
    public function getEtoiles(): Collection
    {
        return $this->etoiles;
    }

    public function addEtoile(Etoile $etoile): self
    {
        if (!$this->etoiles->contains($etoile)) {
            $this->etoiles[] = $etoile;
            $etoile->setSystemePlanetaire($this);
        }

        return $this;
    }

    public function removeEtoile(Etoile $etoile): self
    {
        if ($this->etoiles->removeElement($etoile)) {
            // set the owning side to null (unless already changed)
            if ($etoile->getSystemePlanetaire() === $this) {
                $etoile->setSystemePlanetaire(null);
            }
        }

        return $this;
    }
}
