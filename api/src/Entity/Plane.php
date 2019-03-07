<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"plane:output"}},
 *     denormalizationContext={"groups"={"plane:input"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PlaneRepository")
 */
class Plane
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"plane:input"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"plane:output","user:input"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"plane:output","user:input"})
     */
    private $capacity;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Pilot", cascade={"persist", "remove"})
     * @Groups({"plane:output","user:input"})
     */
    private $Pilot;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Mission", inversedBy="planes")
     * @Groups({"plane:output"})
     */
    private $Mission;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="planes")
     * @Groups({"plane:output","user:input"})
     * @ApiSubresource()
     */
    private $company;

    public function __construct()
    {
        $this->Mission = new ArrayCollection();
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

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getPilot(): ?Pilot
    {
        return $this->Pilot;
    }

    public function setPilot(?Pilot $Pilot): self
    {
        $this->Pilot = $Pilot;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMission(): Collection
    {
        return $this->Mission;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->Mission->contains($mission)) {
            $this->Mission[] = $mission;
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->Mission->contains($mission)) {
            $this->Mission->removeElement($mission);
        }

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
