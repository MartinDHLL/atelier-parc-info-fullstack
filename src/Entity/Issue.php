<?php

namespace App\Entity;

use App\Repository\IssueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IssueRepository::class)]
class Issue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'issues', targetEntity: TicketAction::class)]
    private Collection $ticketActions;

    #[ORM\OneToMany(mappedBy: 'issue', targetEntity: Solution::class)]
    private Collection $solutions;

    public function __construct()
    {
        $this->ticketActions = new ArrayCollection();
        $this->solutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = strtolower($intitule);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = strtolower($description);

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
            $ticketAction->setIssues($this);
        }

        return $this;
    }

    public function removeTicketAction(TicketAction $ticketAction): self
    {
        if ($this->ticketActions->removeElement($ticketAction)) {
            // set the owning side to null (unless already changed)
            if ($ticketAction->getIssues() === $this) {
                $ticketAction->setIssues(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Solution>
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(Solution $solution): self
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions->add($solution);
            $solution->setIssue($this);
        }

        return $this;
    }

    public function removeSolution(Solution $solution): self
    {
        if ($this->solutions->removeElement($solution)) {
            // set the owning side to null (unless already changed)
            if ($solution->getIssue() === $this) {
                $solution->setIssue(null);
            }
        }

        return $this;
    }
}
