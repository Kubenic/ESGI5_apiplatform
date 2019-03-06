<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_reduction;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_reduction;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cumulable;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ticket", mappedBy="offer")
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeReduction(): ?string
    {
        return $this->type_reduction;
    }

    public function setTypeReduction(string $type_reduction): self
    {
        $this->type_reduction = $type_reduction;

        return $this;
    }

    public function getNumberReduction(): ?int
    {
        return $this->number_reduction;
    }

    public function setNumberReduction(int $number_reduction): self
    {
        $this->number_reduction = $number_reduction;

        return $this;
    }

    public function getCumulable(): ?bool
    {
        return $this->cumulable;
    }

    public function setCumulable(bool $cumulable): self
    {
        $this->cumulable = $cumulable;

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
            $ticket->addOffer($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            $ticket->removeOffer($this);
        }

        return $this;
    }
}
