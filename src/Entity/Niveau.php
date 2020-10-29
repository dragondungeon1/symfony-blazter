<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Klas::class, mappedBy="niveau_id")
     */
    private $niveau_id;

    public function __construct()
    {
        $this->niveau_id = new ArrayCollection();
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


    public function __toString() {
        return $this->getName();
    }

    /**
     * @return Collection|Klas[]
     */
    public function getNiveauId(): Collection
    {
        return $this->niveau_id;
    }

    public function addNiveauId(Klas $niveauId): self
    {
        if (!$this->niveau_id->contains($niveauId)) {
            $this->niveau_id[] = $niveauId;
            $niveauId->setNiveauId($this);
        }

        return $this;
    }

    public function removeNiveauId(Klas $niveauId): self
    {
        if ($this->niveau_id->contains($niveauId)) {
            $this->niveau_id->removeElement($niveauId);
            // set the owning side to null (unless already changed)
            if ($niveauId->getNiveauId() === $this) {
                $niveauId->setNiveauId(null);
            }
        }

        return $this;
    }
}
