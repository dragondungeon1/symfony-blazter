<?php

namespace App\Entity;

use App\Repository\KlasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KlasRepository::class)
 */
class Klas
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
     * @ORM\ManyToOne(targetEntity=School::class, inversedBy="school_id")
     */
    private $school_id;

    /**
     * @ORM\OneToMany(targetEntity=KlasHasLes::class, mappedBy="klas_id")
     */
    private $klas_id;

    public function __construct()
    {
        $this->klas_id = new ArrayCollection();
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

    public function getSchoolId(): ?School
    {
        return $this->school_id;
    }

    public function setSchoolId(?School $school_id): self
    {
        $this->school_id = $school_id;

        return $this;
    }

    /**
     * @return Collection|KlasHasLes[]
     */
    public function getKlasId(): Collection
    {
        return $this->klas_id;
    }

    public function addKlasId(KlasHasLes $klasId): self
    {
        if (!$this->klas_id->contains($klasId)) {
            $this->klas_id[] = $klasId;
            $klasId->setKlasId($this);
        }

        return $this;
    }

    public function removeKlasId(KlasHasLes $klasId): self
    {
        if ($this->klas_id->contains($klasId)) {
            $this->klas_id->removeElement($klasId);
            // set the owning side to null (unless already changed)
            if ($klasId->getKlasId() === $this) {
                $klasId->setKlasId(null);
            }
        }

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
