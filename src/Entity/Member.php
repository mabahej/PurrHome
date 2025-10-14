<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Member implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 180)]
    private ?string $email = null;
    
    /**
     * @var Collection<int, Vitrine>
     */
    #[ORM\OneToMany(targetEntity: Vitrine::class, mappedBy: 'createur')]
    private Collection $vitrines;
    
    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];
    
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;
    
    #[ORM\OneToOne(inversedBy: 'member', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Refuge $refuge = null;
    
    public function __construct()
    {
        $this->vitrines = new ArrayCollection();
    }
    
    // ─────────────── Getters & Setters ───────────────
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }
    
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
    
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }
    
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
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
            $vitrine->setCreateur($this);
        }
        
        return $this;
    }
    
    public function removeVitrine(Vitrine $vitrine): static
    {
        if ($this->vitrines->removeElement($vitrine)) {
            if ($vitrine->getCreateur() === $this) {
                $vitrine->setCreateur(null);
            }
        }
        
        return $this;
    }
    
    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }
    
    public function getRefuge(): ?Refuge
    {
        return $this->refuge;
    }
    
    public function setRefuge(Refuge $refuge): static
    {
        $this->refuge = $refuge;
        return $this;
    }
}
