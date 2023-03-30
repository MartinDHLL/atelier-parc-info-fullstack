<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: TicketAction::class)]
    private Collection $ticketActions;

    public function __construct()
    {
        $this->ticketActions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = strtolower($type);

        return $this;
    }

    /**
     * @return Collection<int, TicketAction>
     */
    public function getTicketActions(): Collection
    {
        return $this->ticketActions;
    }

    public function addTicketAction(TicketAction $ticketAction): self
    {
        if (!$this->ticketActions->contains($ticketAction)) {
            $this->ticketActions->add($ticketAction);
            $ticketAction->setStatut($this);
        }

        return $this;
    }

    public function removeTicketAction(TicketAction $ticketAction): self
    {
        if ($this->ticketActions->removeElement($ticketAction)) {
            // set the owning side to null (unless already changed)
            if ($ticketAction->getStatut() === $this) {
                $ticketAction->setStatut(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
