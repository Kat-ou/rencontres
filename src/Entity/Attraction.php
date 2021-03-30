<?php

namespace App\Entity;

use App\Repository\AttractionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttractionRepository::class)
 * @UniqueEntity(fields={"user1","user2"})
 */
class Attraction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isOkUser1;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isOkUser2;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMatch;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="attractionsSent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user1;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="attractionsReceived")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user2;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsOkUser1(): ?bool
    {
        return $this->isOkUser1;
    }

    public function setIsOkUser1(?bool $isOkUser1): self
    {
        $this->isOkUser1 = $isOkUser1;

        return $this;
    }

    public function getIsOkUser2(): ?bool
    {
        return $this->isOkUser2;
    }

    public function setIsOkUser2(?bool $isOkUser2): self
    {
        $this->isOkUser2 = $isOkUser2;

        return $this;
    }

    public function getIsMatch(): ?bool
    {
        return $this->isMatch;
    }

    public function setIsMatch(?bool $isMatch): self
    {
        $this->isMatch = $isMatch;

        return $this;
    }

    public function getUser1(): ?User
    {
        return $this->user1;
    }

    public function setUser1(?User $user1): self
    {
        $this->user1 = $user1;

        return $this;
    }

    public function getUser2(): ?User
    {
        return $this->user2;
    }

    public function setUser2(?User $user2): self
    {
        $this->user2 = $user2;

        return $this;
    }


}
