<?php

namespace App\Entity;

use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionsRepository::class)]
class Missions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $script = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaires = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $email_rdv_client_text = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $email_rdv_prospect_text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fichier = null;

    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'missions')]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: Champs::class, inversedBy: 'missions')]
    private Collection $champs;

    #[ORM\ManyToMany(targetEntity: Statuts::class)]
    private Collection $statuts;

    #[ORM\ManyToMany(targetEntity: Prerempli::class)]
    private Collection $preremplis;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    private ?Societe $societe = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->champs = new ArrayCollection();
        $this->statuts = new ArrayCollection();
        $this->preremplis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getScript(): ?string
    {
        return $this->script;
    }

    public function setScript(string $script): static
    {
        $this->script = $script;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(string $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getEmailRdvClientText(): ?string
    {
        return $this->email_rdv_client_text;
    }

    public function setEmailRdvClientText(?string $email_rdv_client_text): static
    {
        $this->email_rdv_client_text = $email_rdv_client_text;

        return $this;
    }

    public function getEmailRdvProspectText(): ?string
    {
        return $this->email_rdv_prospect_text;
    }

    public function setEmailRdvProspectText(?string $email_rdv_prospect_text): static
    {
        $this->email_rdv_prospect_text = $email_rdv_prospect_text;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(?string $fichier): static
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Champs>
     */
    public function getChamps(): Collection
    {
        return $this->champs;
    }

    public function addChamp(Champs $champ): static
    {
        if (!$this->champs->contains($champ)) {
            $this->champs->add($champ);
        }

        return $this;
    }

    public function removeChamp(Champs $champ): static
    {
        $this->champs->removeElement($champ);

        return $this;
    }

    /**
     * @return Collection<int, Statuts>
     */
    public function getStatuts(): Collection
    {
        return $this->statuts;
    }

    public function addStatut(Statuts $statut): static
    {
        if (!$this->statuts->contains($statut)) {
            $this->statuts->add($statut);
        }

        return $this;
    }

    public function removeStatut(Statuts $statut): static
    {
        $this->statuts->removeElement($statut);

        return $this;
    }

    /**
     * @return Collection<int, Prerempli>
     */
    public function getPreremplis(): Collection
    {
        return $this->preremplis;
    }

    public function addPrerempli(Prerempli $prerempli): static
    {
        if (!$this->preremplis->contains($prerempli)) {
            $this->preremplis->add($prerempli);
        }

        return $this;
    }

    public function removePrerempli(Prerempli $prerempli): static
    {
        $this->preremplis->removeElement($prerempli);

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
    {
        $this->societe = $societe;

        return $this;
    }
}
