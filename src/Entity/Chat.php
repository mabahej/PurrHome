<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $race = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sexe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat_sante = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'chats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Refuge $id_refuge = null;

    /**
     * @var Collection<int, Vitrine>
     */
    #[ORM\ManyToMany(targetEntity: Vitrine::class, mappedBy: 'chats')]
    private Collection $vitrines;

    public function __construct()
    {
        $this->vitrines = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(?string $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getEtatSante(): ?string
    {
        return $this->etat_sante;
    }

    public function setEtatSante(?string $etat_sante): static
    {
        $this->etat_sante = $etat_sante;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdRefuge(): ?Refuge
    {
        return $this->id_refuge;
    }

    public function setIdRefuge(?Refuge $id_refuge): static
    {
        $this->id_refuge = $id_refuge;

        return $this;
    }

   
    public function __toString(): string
    {
        return $this->nom ?? 'Chat #' . $this->id;
    }

    /**
     * @return Collection<int, Vitrine>
     */
    public function getVitrines(): Collection
    {
        return $this->vitrines;
    }

    public function addVitrine(Vitrine $vitrine): static
    {
        if (!$this->vitrines->contains($vitrine)) {
            $this->vitrines->add($vitrine);
            $vitrine->addChat($this);
        }

        return $this;
    }

    public function removeVitrine(Vitrine $vitrine): static
    {
        if ($this->vitrines->removeElement($vitrine)) {
            $vitrine->removeChat($this);
        }

        return $this;
    }
}
