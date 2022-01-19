<?php

namespace App\Entity;

use App\Repository\SuperamasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperamasRepository::class)]
class Superamas
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

    #[ORM\ManyToOne(targetEntity: SuperamasGalaxies::class, inversedBy: 'superamas')]
    #[ORM\JoinColumn(nullable: false)]
    private $SuperamasGalaxies;

    #[ORM\OneToMany(mappedBy: 'Superamas', targetEntity: GroupeGalaxies::class, orphanRemoval: true)]
    private $groupeGalaxies;

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
        $this->groupeGalaxies = new ArrayCollection();
    }

    public function getSuperamasGalaxies(): ?SuperamasGalaxies
    {
        return $this->SuperamasGalaxies;
    }

    public function setSuperamasGalaxies(?SuperamasGalaxies $SuperamasGalaxies): self
    {
        $this->SuperamasGalaxies = $SuperamasGalaxies;

        return $this;
    }

    /**
     * @return Collection|GroupeGalaxies[]
     */
    public function getGroupeGalaxies(): Collection
    {
        return $this->groupeGalaxies;
    }

    public function addGroupeGalaxy(GroupeGalaxies $groupeGalaxy): self
    {
        if (!$this->groupeGalaxies->contains($groupeGalaxy)) {
            $this->groupeGalaxies[] = $groupeGalaxy;
            $groupeGalaxy->setSuperamas($this);
        }

        return $this;
    }

    public function removeGroupeGalaxy(GroupeGalaxies $groupeGalaxy): self
    {
        if ($this->groupeGalaxies->removeElement($groupeGalaxy)) {
            // set the owning side to null (unless already changed)
            if ($groupeGalaxy->getSuperamas() === $this) {
                $groupeGalaxy->setSuperamas(null);
            }
        }

        return $this;
    }
}
