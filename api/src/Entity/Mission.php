<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MissionRepository")
 */
class Mission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @Assert\GreaterThan(propertyPath="start_date")
     * @Assert\NotEqualTo(propertyPath="start_date")
     */
    private $end_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="mission")
     */
    private $tickets;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plane", mappedBy="Mission")
     */
    private $planes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="end_location")
     */
    private $start_location;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="missions")
     */
    private $end_location;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $start_terminal;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $end_terminal;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->planes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setMission($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getMission() === $this) {
                $ticket->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Plane[]
     */
    public function getPlanes(): Collection
    {
        return $this->planes;
    }

    public function addPlane(Plane $plane): self
    {
        if (!$this->planes->contains($plane)) {
            $this->planes[] = $plane;
            $plane->addMission($this);
        }

        return $this;
    }

    public function removePlane(Plane $plane): self
    {
        if ($this->planes->contains($plane)) {
            $this->planes->removeElement($plane);
            $plane->removeMission($this);
        }

        return $this;
    }

    public function getStartLocation(): ?Airport
    {
        return $this->start_location;
    }

    public function setStartLocation(?Airport $start_location): self
    {
        $this->start_location = $start_location;

        return $this;
    }

    public function getEndLocation(): ?Airport
    {
        return $this->end_location;
    }

    public function setEndLocation(?Airport $end_location): self
    {
        $this->end_location = $end_location;

        return $this;
    }

    public function getStartTerminal(): ?string
    {
        return $this->start_terminal;
    }

    public function setStartTerminal(string $start_terminal): self
    {
        $this->start_terminal = $start_terminal;

        return $this;
    }

    public function getEndTerminal(): ?string
    {
        return $this->end_terminal;
    }

    public function setEndTerminal(string $end_terminal): self
    {
        $this->end_terminal = $end_terminal;

        return $this;
    }
}
