<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(length:255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Hardware::class)]
    private Collection $hardwares;

    public function __construct()
    {
        $this->hardwares = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = strtolower($nom);

        return $this;
    }

    /**
     * @return Collection<int, Hardware>
     */
    public function getHardwares(): Collection
    {
        return $this->hardwares;
    }

    public function addHardware(Hardware $hardware): self
    {
        if (!$this->hardwares->contains($hardware)) {
            $this->hardwares->add($hardware);
            $hardware->setType($this);
        }

        return $this;
    }

    public function removeHardware(Hardware $hardware): self
    {
        if ($this->hardwares->removeElement($hardware)) {
            // set the owning side to null (unless already changed)
            if ($hardware->getType() === $this) {
                $hardware->setType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
