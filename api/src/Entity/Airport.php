<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\ContainsAlphanumeric;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AirportRepository")
 */
class Airport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    private $acronym;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @ContainsAlphanumeric()
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @ContainsAlphanumeric()
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mission", mappedBy="start_location")
     */
    private $end_location;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mission", mappedBy="end_location")
     */
    private $missions;

    public function __construct()
    {
        $this->end_location = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAcronym(): ?string
    {
        return $this->acronym;
    }

    public function setAcronym(string $acronym): self
    {
        $this->acronym = $acronym;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getEndLocation(): Collection
    {
        return $this->end_location;
    }

    public function addEndLocation(Mission $endLocation): self
    {
        if (!$this->end_location->contains($endLocation)) {
            $this->end_location[] = $endLocation;
            $endLocation->setStartLocation($this);
        }

        return $this;
    }

    public function removeEndLocation(Mission $endLocation): self
    {
        if ($this->end_location->contains($endLocation)) {
            $this->end_location->removeElement($endLocation);
            // set the owning side to null (unless already changed)
            if ($endLocation->getStartLocation() === $this) {
                $endLocation->setStartLocation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setEndLocation($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getEndLocation() === $this) {
                $mission->setEndLocation(null);
            }
        }

        return $this;
    }
}
