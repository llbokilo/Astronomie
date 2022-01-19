<?php

namespace App\Entity;

use App\Repository\SuperamasGalaxiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperamasGalaxiesRepository::class)]
class SuperamasGalaxies
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

    #[ORM\OneToMany(mappedBy: 'SuperamasGalaxies', targetEntity: Superamas::class, orphanRemoval: true)]
    private $superamas;

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
        $this->superamas = new ArrayCollection();
    }

    /**
     * @return Collection|Superamas[]
     */
    public function getSuperamas(): Collection
    {
        return $this->superamas;
    }

    public function addSuperama(Superamas $superama): self
    {
        if (!$this->superamas->contains($superama)) {
            $this->superamas[] = $superama;
            $superama->setSuperamasGalaxies($this);
        }

        return $this;
    }

    public function removeSuperama(Superamas $superama): self
    {
        if ($this->superamas->removeElement($superama)) {
            // set the owning side to null (unless already changed)
            if ($superama->getSuperamasGalaxies() === $this) {
                $superama->setSuperamasGalaxies(null);
            }
        }

        return $this;
    }
}
