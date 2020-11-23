<?php

namespace App\Entity;

use App\Repository\RipdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RipdRepository::class)
 */
class Ripd
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
    private $control;

    /**
     * @ORM\Column(type="integer")
     */
    private $operator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reason;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getControl(): ?int
    {
        return $this->control;
    }

    public function setControl(int $control): self
    {
        $this->control = $control;

        return $this;
    }

    public function getOperator(): ?int
    {
        return $this->operator;
    }

    public function setOperator(int $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

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
}
