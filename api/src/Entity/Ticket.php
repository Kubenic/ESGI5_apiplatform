<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Luggage", mappedBy="ticket")
     */
    private $luggage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Traveler", inversedBy="offer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $traveler;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Offer", inversedBy="tickets")
     */
    private $offer;

    public function __construct()
    {
        $this->luggage = new ArrayCollection();
        $this->offer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Luggage[]
     */
    public function getLuggage(): Collection
    {
        return $this->luggage;
    }

    public function addLuggage(Luggage $luggage): self
    {
        if (!$this->luggage->contains($luggage)) {
            $this->luggage[] = $luggage;
            $luggage->setTicket($this);
        }

        return $this;
    }

    public function removeLuggage(Luggage $luggage): self
    {
        if ($this->luggage->contains($luggage)) {
            $this->luggage->removeElement($luggage);
            // set the owning side to null (unless already changed)
            if ($luggage->getTicket() === $this) {
                $luggage->setTicket(null);
            }
        }

        return $this;
    }

    public function getTraveler(): ?Traveler
    {
        return $this->traveler;
    }

    public function setTraveler(?Traveler $traveler): self
    {
        $this->traveler = $traveler;

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffer(): Collection
    {
        return $this->offer;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offer->contains($offer)) {
            $this->offer[] = $offer;
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offer->contains($offer)) {
            $this->offer->removeElement($offer);
        }

        return $this;
    }
}
