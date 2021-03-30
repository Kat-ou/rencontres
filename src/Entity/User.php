<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $username;

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, inversedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $profil;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", nullable=true )
     */
    private $dateUpdated;


    /**
     * @ORM\OneToMany(targetEntity=SearchCriteria::class, mappedBy="user")
     */
    private $searchCriterias;

    /**
     * @ORM\OneToMany(targetEntity=Attraction::class, mappedBy="user1")
     */
    private $attractionsSent;

    /**
     * @ORM\OneToMany(targetEntity=Attraction::class, mappedBy="user2")
     */
    private $attractionsReceived;

    public function __construct()
    {
        $this->searchCriterias = new ArrayCollection();
        $this->attractionsSent = new ArrayCollection();
        $this->attractionsReceived = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {

        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(\DateTimeInterface $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * @return Collection|SearchCriteria[]
     */
    public function getSearchCriterias(): Collection
    {
        return $this->searchCriterias;
    }

    public function addSearchCriteria(SearchCriteria $searchCriteria): self
    {
        if (!$this->searchCriterias->contains($searchCriteria)) {
            $this->searchCriterias[] = $searchCriteria;
            $searchCriteria->setUser($this);
        }

        return $this;
    }

    public function removeSearchCriteria(SearchCriteria $searchCriteria): self
    {
        if ($this->searchCriterias->removeElement($searchCriteria)) {
            // set the owning side to null (unless already changed)
            if ($searchCriteria->getUser() === $this) {
                $searchCriteria->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Attraction[]
     */
    public function getAttractionsSent(): Collection
    {
        return $this->attractionsSent;
    }

    public function addAttractionsSent(Attraction $attractionsSent): self
    {
        if (!$this->attractionsSent->contains($attractionsSent)) {
            $this->attractionsSent[] = $attractionsSent;
            $attractionsSent->setUser1($this);
        }

        return $this;
    }

    public function removeAttractionsSent(Attraction $attractionsSent): self
    {
        if ($this->attractionsSent->removeElement($attractionsSent)) {
            // set the owning side to null (unless already changed)
            if ($attractionsSent->getUser1() === $this) {
                $attractionsSent->setUser1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Attraction[]
     */
    public function getAttractionsReceived(): Collection
    {
        return $this->attractionsReceived;
    }

    public function addAttractionsReceived(Attraction $attractionsReceived): self
    {
        if (!$this->attractionsReceived->contains($attractionsReceived)) {
            $this->attractionsReceived[] = $attractionsReceived;
            $attractionsReceived->setUser2($this);
        }

        return $this;
    }

    public function removeAttractionsReceived(Attraction $attractionsReceived): self
    {
        if ($this->attractionsReceived->removeElement($attractionsReceived)) {
            // set the owning side to null (unless already changed)
            if ($attractionsReceived->getUser2() === $this) {
                $attractionsReceived->setUser2(null);
            }
        }

        return $this;
    }
}
