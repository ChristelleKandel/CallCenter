<?php

namespace App\Entity;

use App\Repository\ChampsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampsRepository::class)]
class Champs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_champ = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $type_champ = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomChamp(): ?string
    {
        return $this->nom_champ;
    }

    public function setNomChamp(string $nom_champ): static
    {
        $this->nom_champ = $nom_champ;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getTypeChamp(): ?string
    {
        return $this->type_champ;
    }

    public function setTypeChamp(string $type_champ): static
    {
        $this->type_champ = $type_champ;

        return $this;
    }
}
