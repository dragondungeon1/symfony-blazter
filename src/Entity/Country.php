<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
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
     * @ORM\OneToMany(targetEntity=School::class, mappedBy="country")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=School::class, mappedBy="countryID")
     */
    private $Country;

    public function __construct()
    {
        $this->country = new ArrayCollection();
        $this->Country = new ArrayCollection();
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

    /**
     * @return Collection|School[]
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(School $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country[] = $country;
            $country->setCountry($this);
        }

        return $this;
    }

    public function removeCountry(School $country): self
    {
        if ($this->country->contains($country)) {
            $this->country->removeElement($country);
            // set the owning side to null (unless already changed)
            if ($country->getCountry() === $this) {
                $country->setCountry(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
