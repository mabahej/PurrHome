<?php

namespace App\Entity;

use App\Repository\VitrineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VitrineRepository::class)]
class Vitrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $photo_url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'vitrines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chat $chat = null;

    #[ORM\Column]
    private ?bool $publiee = null;

    #[ORM\ManyToOne(inversedBy: 'vitrines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Member $createur = null;
    
    // And update the getter/setter:
    public function getCreateur(): ?Member
    {
        return $this->createur;
    }
    
    public function setCreateur(?Member $createur): static
    {
        $this->createur = $createur;
        return $this;
    }
    /**
     * @var Collection<int, Chat>
     */
    #[ORM\ManyToMany(targetEntity: Chat::class, inversedBy: 'vitrines')]
    private Collection $chats;

    public function __construct()
    {
        $this->chats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photo_url;
    }

    public function setPhotoUrl(string $photo_url): static
    {
        $this->photo_url = $photo_url;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }

    public function isPubliee(): ?bool
    {
        return $this->publiee;
    }

    public function setPubliee(bool $publiee): static
    {
        $this->publiee = $publiee;

        return $this;
    }

   

    /**
     * @return Collection<int, Chat>
     */
    public function getChats(): Collection
    {
        return $this->chats;
    }

    public function addChat(Chat $chat): static
    {
        if (!$this->chats->contains($chat)) {
            $this->chats->add($chat);
        }

        return $this;
    }

    public function removeChat(Chat $chat): static
    {
        $this->chats->removeElement($chat);

        return $this;
    }
}
