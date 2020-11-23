<?php

namespace App\Entity;

use App\Repository\VooRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VooRepository::class)
 */
class Voo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $airplane;

    /**
     * @ORM\Column(type="integer")
     */
    private $city_from;

    /**
     * @ORM\Column(type="integer")
     */
    private $city_to;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departure;

    /**
     * @ORM\Column(type="integer")
     */
    private $time;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modified_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAirplane(): ?int
    {
        return $this->airplane;
    }

    public function setAirplane(int $airplane): self
    {
        $this->airplane = $airplane;

        return $this;
    }

    public function getCityFrom(): ?int
    {
        return $this->city_from;
    }

    public function setCityFrom(int $city_from): self
    {
        $this->city_from = $city_from;

        return $this;
    }

    public function getCityTo(): ?int
    {
        return $this->city_to;
    }

    public function setCityTo(int $city_to): self
    {
        $this->city_to = $city_to;

        return $this;
    }

    public function getDeparture(): ?\DateTimeInterface
    {
        return $this->departure;
    }

    public function setDeparture(\DateTimeInterface $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTimeInterface $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
