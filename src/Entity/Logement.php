<?php

namespace App\Entity;

use App\Repository\LogementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogementRepository::class)]
class Logement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\OneToOne(mappedBy: 'logement', cascade: ['persist', 'remove'])]
    private ?Reservation $reservation = null;

    // #[ORM\OneToOne(mappedBy: 'logement', cascade: ['persist', 'remove'])]
    // private ?Description $description = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $chambre = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column]
    private ?int $salleBain = null;

    #[ORM\Column(nullable: true)]
    private ?bool $jardin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        // set the owning side of the relation if necessary
        if ($reservation->getIdLogement() !== $this) {
            $reservation->setIdLogement($this);
        }

        $this->reservation = $reservation;

        return $this;
    }

    // public function getDescription(): ?Description
    // {
    //     return $this->description;
    // }

    // public function setDescription(Description $description): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($description->getIdLogement() !== $this) {
    //         $description->setIdLogement($this);
    //     }

    //     $this->description = $description;

    //     return $this;
    // }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getChambre(): ?int
    {
        return $this->chambre;
    }

    public function setChambre(int $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getSalleBain(): ?int
    {
        return $this->salleBain;
    }

    public function setSalleBain(int $salleBain): self
    {
        $this->salleBain = $salleBain;

        return $this;
    }

    public function isJardin(): ?bool
    {
        return $this->jardin;
    }

    public function setJardin(?bool $jardin): self
    {
        $this->jardin = $jardin;

        return $this;
    }


     public function __toString(){
       
        return $this->titre;
       
    }
}
