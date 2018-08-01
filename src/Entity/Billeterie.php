<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BilleterieRepository")
 */
class Billeterie
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
    private $placeRestantes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaceRestantes(): ?int
    {
        return $this->placeRestantes;
    }

    public function setPlaceRestantes(int $placeRestantes): self
    {
        $this->placeRestantes = $placeRestantes;

        return $this;
    }
}
