<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{

    use BaseEntityTrait;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

  

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filePath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $legende;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voyage", inversedBy="photo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voyage;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

  

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getLegende(): ?string
    {
        return $this->legende;
    }

    public function setLegende(?string $legende): self
    {
        $this->legende = $legende;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): self
    {
        $this->voyage = $voyage;

        return $this;
    }

    
}
