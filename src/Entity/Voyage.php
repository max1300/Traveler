<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoyageRepository")
 */
class Voyage
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destinations", inversedBy="voyage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voyage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="voyage", orphanRemoval=true)
     */
    private $photo;

    public function __construct()
    {
        $this->photo = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getVoyage(): ?Destinations
    {
        return $this->voyage;
    }

    public function setVoyage(?Destinations $voyage): self
    {
        $this->voyage = $voyage;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo[] = $photo;
            $photo->setVoyage($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photo->contains($photo)) {
            $this->photo->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getVoyage() === $this) {
                $photo->setVoyage(null);
            }
        }

        return $this;
    }
}
