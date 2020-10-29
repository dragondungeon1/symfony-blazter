<?php

namespace App\Entity;

use App\Repository\KlasHasLesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KlasHasLesRepository::class)
 */
class KlasHasLes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $vervallen;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $opvang;

    /**
     * @ORM\ManyToOne(targetEntity=Klas::class, inversedBy="klas_id")
     */
    private $klas_id;

    /**
     * @ORM\ManyToOne(targetEntity=Les::class, inversedBy="les_id")
     */
    private $les_id;

    /**
     * @ORM\ManyToOne(targetEntity=Rooster::class, inversedBy="rooster")
     */
    private $rooster_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVervallen(): ?bool
    {
        return $this->vervallen;
    }

    public function setVervallen(?bool $vervallen): self
    {
        $this->vervallen = $vervallen;

        return $this;
    }

    public function getOpvang(): ?bool
    {
        return $this->opvang;
    }

    public function setOpvang(?bool $opvang): self
    {
        $this->opvang = $opvang;

        return $this;
    }

    public function getKlasId(): ?Klas
    {
        return $this->klas_id;
    }

    public function setKlasId(?Klas $klas_id): self
    {
        $this->klas_id = $klas_id;

        return $this;
    }

    public function getLesId(): ?Les
    {
        return $this->les_id;
    }

    public function setLesId(?Les $les_id): self
    {
        $this->les_id = $les_id;

        return $this;
    }

    public function getRoosterId(): ?Rooster
    {
        return $this->rooster_id;
    }

    public function setRoosterId(?Rooster $rooster_id): self
    {
        $this->rooster_id = $rooster_id;

        return $this;
    }
}
