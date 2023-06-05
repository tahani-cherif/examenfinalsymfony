<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $matriculejoueur = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    private ?Partie $idpartie = null;

    public function getMatriculejoueur(): ?int
    {
        return $this->matriculejoueur;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    public function setMatriculejoueur(int $matriculejoueur): self
    {
        $this->matriculejoueur = $matriculejoueur;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getIdpartie(): ?Partie
    {
        return $this->idpartie;
    }

    public function setIdpartie(?Partie $idpartie): self
    {
        $this->idpartie = $idpartie;

        return $this;
    }
}
