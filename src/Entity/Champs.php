<?php

namespace App\Entity;

use App\Repository\ChampsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column]
    private ?bool $nullable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $extras = null;

    #[ORM\Column]
    private ?bool $visibleForm = null;

    #[ORM\Column]
    private ?bool $modifiableClient = null;

    #[ORM\ManyToMany(targetEntity: Missions::class, mappedBy: 'champs')]
    private Collection $missions;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $position = null;

    #[ORM\Column(nullable: true)]
    private ?bool $triable = null;

    #[ORM\Column(nullable: true)]
    private ?bool $obligatoire = null;

    #[ORM\Column(nullable: true)]
    private ?bool $multiple = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $valueMultiple = null;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

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

    public function isNullable(): ?bool
    {
        return $this->nullable;
    }

    public function setNullable(bool $nullable): static
    {
        $this->nullable = $nullable;

        return $this;
    }

    public function getExtras(): ?string
    {
        return $this->extras;
    }

    public function setExtras(?string $extras): static
    {
        $this->extras = $extras;

        return $this;
    }

    public function isVisibleForm(): ?bool
    {
        return $this->visibleForm;
    }

    public function setVisibleForm(bool $visibleForm): static
    {
        $this->visibleForm = $visibleForm;

        return $this;
    }

    public function isModifiableClient(): ?bool
    {
        return $this->modifiableClient;
    }

    public function setModifiableClient(bool $modifiableClient): static
    {
        $this->modifiableClient = $modifiableClient;

        return $this;
    }

    /**
     * @return Collection<int, Missions>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Missions $mission): static
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->addChamp($this);
        }

        return $this;
    }

    public function removeMission(Missions $mission): static
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeChamp($this);
        }

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function isTriable(): ?bool
    {
        return $this->triable;
    }

    public function setTriable(?bool $triable): static
    {
        $this->triable = $triable;

        return $this;
    }

    public function isObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(?bool $obligatoire): static
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    public function isMultiple(): ?bool
    {
        return $this->multiple;
    }

    public function setMultiple(?bool $multiple): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getValueMultiple(): ?string
    {
        return $this->valueMultiple;
    }

    public function setValueMultiple(?string $valueMultiple): static
    {
        $this->valueMultiple = $valueMultiple;

        return $this;
    }
}
