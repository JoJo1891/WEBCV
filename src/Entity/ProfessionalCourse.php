<?php

namespace App\Entity;

use App\Repository\ProfessionalCourseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfessionalCourseRepository::class)
 */
class ProfessionalCourse
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $period;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skillsacquired;

    /**
     * @ORM\ManyToOne(targetEntity=Cv::class, inversedBy="professionalCourses")
     */
    private $idCv;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(string $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getSkillsacquired(): ?string
    {
        return $this->skillsacquired;
    }

    public function setSkillsacquired(string $skillsacquired): self
    {
        $this->skillsacquired = $skillsacquired;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
