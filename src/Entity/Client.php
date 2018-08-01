<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Abonnement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $abonnement;
    
    /**
     * @ORM\Column(type="date")
     */
    private $age;
    
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isStudent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        $this->abonnement = $abonnement;

        return $this;
    }
    
    public function setAge($age){
        $this->age = $age;
        return $this;
    }
    
    public function getAge(){
        return $this->age;
    }
    
    public function getIsStudent(){
        return $this->isStudent;
    }
    
    public function setIsStudent($val){
        $this->isStudent = $val;
        return $this;
    }
    
}
