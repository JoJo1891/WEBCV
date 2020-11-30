<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingRepository::class)
 */
class Training
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
    private $diplomatitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $school;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearofgraduation;

    /**
     * @ORM\ManyToOne(targetEntity=Cv::class, inversedBy="trainings")
     */
    private $idCv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiplomatitle(): ?string
    {
        return $this->diplomatitle;
    }

    public function setDiplomatitle(string $diplomatitle): self
    {
        $this->diplomatitle = $diplomatitle;

        return $this;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getYearofgraduation(): ?int
    {
        return $this->yearofgraduation;
    }

    public function setYearofgraduation(int $yearofgraduation): self
    {
        $this->yearofgraduation = $yearofgraduation;

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
