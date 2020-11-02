<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
 */
class School
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
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=Klas::class, mappedBy="school_id")
     */
    private $school_id;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="country")
     */
    private $country;

    public function __construct()
    {
        $this->school_id = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
//        $this->setCreatedAt(new \DateTime('now'));

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;
//        $this->setUpdatedAt(new \DateTime('now'));

        return $this;
    }

    /**
     * @return Collection|Klas[]
     */
    public function getSchoolId(): Collection
    {
        return $this->school_id;
    }

    public function addSchoolId(Klas $schoolId): self
    {
        if (!$this->school_id->contains($schoolId)) {
            $this->school_id[] = $schoolId;
            $schoolId->setSchoolId($this);
        }

        return $this;
    }

    public function removeSchoolId(Klas $schoolId): self
    {
        if ($this->school_id->contains($schoolId)) {
            $this->school_id->removeElement($schoolId);
            // set the owning side to null (unless already changed)
            if ($schoolId->getSchoolId() === $this) {
                $schoolId->setSchoolId(null);
            }
        }

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
