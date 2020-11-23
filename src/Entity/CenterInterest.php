<?php

namespace App\Entity;

use App\Repository\CenterInterestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CenterInterestRepository::class)
 */
class CenterInterest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Cv::class, inversedBy="centerInterests")
     */
    private $idCv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdCv(): ?Cv
    {
        return $this->idCv;
    }

    public function setIdCv(?Cv $idCv): self
    {
        $this->idCv = $idCv;

        return $this;
    }
}
