<?php

namespace App\Entity;

use App\Repository\RoosterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoosterRepository::class)
 */
class Rooster
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
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\OneToMany(targetEntity=KlasHasLes::class, mappedBy="rooster_id")
     */
    private $rooster;

    public function __construct()
    {
        $this->rooster = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return Collection|KlasHasLes[]
     */
    public function getRooster(): Collection
    {
        return $this->rooster;
    }

    public function addRooster(KlasHasLes $rooster): self
    {
        if (!$this->rooster->contains($rooster)) {
            $this->rooster[] = $rooster;
            $rooster->setRoosterId($this);
        }

        return $this;
    }

    public function removeRooster(KlasHasLes $rooster): self
    {
        if ($this->rooster->contains($rooster)) {
            $this->rooster->removeElement($rooster);
            // set the owning side to null (unless already changed)
            if ($rooster->getRoosterId() === $this) {
                $rooster->setRoosterId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return "$this->id";
    }
}
