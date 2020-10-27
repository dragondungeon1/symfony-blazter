<?php

namespace App\Entity;

use App\Repository\LesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LesRepository::class)
 */
class Les
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
     * @ORM\OneToMany(targetEntity=KlasHasLes::class, mappedBy="les_id")
     */
    private $les_id;

    public function __construct()
    {
        $this->les_id = new ArrayCollection();
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
     * @return Collection|KlasHasLes[]
     */
    public function getLesId(): Collection
    {
        return $this->les_id;
    }

    public function addLesId(KlasHasLes $lesId): self
    {
        if (!$this->les_id->contains($lesId)) {
            $this->les_id[] = $lesId;
            $lesId->setLesId($this);
        }

        return $this;
    }

    public function removeLesId(KlasHasLes $lesId): self
    {
        if ($this->les_id->contains($lesId)) {
            $this->les_id->removeElement($lesId);
            // set the owning side to null (unless already changed)
            if ($lesId->getLesId() === $this) {
                $lesId->setLesId(null);
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
