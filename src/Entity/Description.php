<?php

namespace App\Entity;

use App\Repository\DescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DescriptionRepository::class)]
class Description
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    // #[ORM\OneToOne(inversedBy: 'description', cascade: ['persist', 'remove'])]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Logement $logement = null;

  

    #[ORM\Column]
    private ?int $chambre = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column(nullable: true)]
    private ?bool $jardin = null;

    #[ORM\Column]
    private ?int $salleBain = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getIdLogement(): ?Logement
    // {
    //     return $this->logement;
    // }

    // public function setIdLogement(Logement $logement): self
    // {
    //     $this->logement = $logement;

    //     return $this;
    // }


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

    public function isJardin(): ?bool
    {
        return $this->jardin;
    }

    public function setJardin(?bool $jardin): self
    {
        $this->jardin = $jardin;

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

        // public function __toString(){
        
        //     return $this->id;
        
        // }
}
