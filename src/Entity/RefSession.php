<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RefSessionRepository")
 */
class RefSession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $effectiftotal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEffectiftotal(): ?int
    {
        return $this->effectiftotal;
    }

    public function setEffectiftotal(int $effectiftotal): self
    {
        $this->effectiftotal = $effectiftotal;

        return $this;
    }
}
