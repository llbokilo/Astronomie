<?php

namespace App\Entity;

use App\Repository\BrasSpiralRepository;
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
}
