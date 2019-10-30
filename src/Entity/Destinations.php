<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DestinationsRepository")
 */
class Destinations
{
    use BaseEntityTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lng;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voyage", mappedBy="voyage", orphanRemoval=true)
     */
    private $voyage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays", inversedBy="destinations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;


    public function __construct()
    {
        $this->voyage = new ArrayCollection();
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyage(): Collection
    {
        return $this->voyage;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyage->contains($voyage)) {
            $this->voyage[] = $voyage;
            $voyage->setVoyage($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyage->contains($voyage)) {
            $this->voyage->removeElement($voyage);
            // set the owning side to null (unless already changed)
            if ($voyage->getVoyage() === $this) {
                $voyage->setVoyage(null);
            }
        }

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }


}
