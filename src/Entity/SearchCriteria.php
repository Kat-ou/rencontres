<?php

namespace App\Entity;

use App\Repository\SearchCriteriaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SearchCriteriaRepository::class)
 */
class SearchCriteria
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minimumAge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maximumAge;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $male;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $female;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $other;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $area1;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default": "0"}))
     */
    private $area2;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default": "0"}))
     */
    private $area3;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="searchCriteria", cascade={"persist", "remove"})
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinimumAge(): ?int
    {
        return $this->minimumAge;
    }

    public function setMinimumAge(?int $minimumAge): self
    {
        $this->minimumAge = $minimumAge;

        return $this;
    }

    public function getMaximumAge(): ?int
    {
        return $this->maximumAge;
    }

    public function setMaximumAge(?int $maximumAge): self
    {
        $this->maximumAge = $maximumAge;

        return $this;
    }

    public function getMale(): ?bool
    {
        return $this->male;
    }

    public function setMale(?bool $male): self
    {
        $this->male = $male;

        return $this;
    }

    public function getFemale(): ?bool
    {
        return $this->female;
    }

    public function setFemale(?bool $female): self
    {
        $this->female = $female;

        return $this;
    }

    public function getOther(): ?bool
    {
        return $this->other;
    }

    public function setOther(?bool $other): self
    {
        $this->other = $other;

        return $this;
    }

    public function getArea1(): ?int
    {
        return $this->area1;
    }

    public function setArea1(int $area1): self
    {
        $this->area1 = $area1;

        return $this;
    }

    public function getArea2(): ?int
    {
        return $this->area2;
    }

    public function setArea2(?int $area2): self
    {
        $this->area2 = $area2;

        return $this;
    }

    public function getArea3(): ?int
    {
        return $this->area3;
    }

    public function setArea3(?int $area3): self
    {
        $this->area3 = $area3;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setSearchCriteria(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getSearchCriteria() !== $this) {
            $user->setSearchCriteria($this);
        }

        $this->user = $user;

        return $this;
    }

}
