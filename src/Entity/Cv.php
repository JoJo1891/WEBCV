<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CvRepository::class)
 */
class Cv
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
     * @ORM\OneToMany(targetEntity=InfosPerso::class, mappedBy="idCv")
     */
    private $infosPersos;

    /**
     * @ORM\OneToMany(targetEntity=ContactInformation::class, mappedBy="idCv")
     */
    private $contactInformation;

    /**
     * @ORM\OneToMany(targetEntity=Skills::class, mappedBy="idCv")
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity=ProfessionalCourse::class, mappedBy="idCv")
     */
    private $professionalCourses;

    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="idCv")
     */
    private $trainings;

    /**
     * @ORM\OneToMany(targetEntity=CenterInterest::class, mappedBy="idCv")
     */
    private $centerInterests;

    /**
     * @ORM\OneToMany(targetEntity=Certificate::class, mappedBy="idCv")
     */
    private $certificates;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cvs")
     */
    private $idUser;

    /**
     * @ORM\OneToMany(targetEntity=Langue::class, mappedBy="idCv")
     */
    private $langues;

    public function __construct()
    {
        $this->infosPersos = new ArrayCollection();
        $this->contactInformation = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->professionalCourses = new ArrayCollection();
        $this->trainings = new ArrayCollection();
        $this->centerInterests = new ArrayCollection();
        $this->certificates = new ArrayCollection();
        $this->langues = new ArrayCollection();
    }

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

    /**
     * @return Collection|InfosPerso[]
     */
    public function getInfosPersos(): Collection
    {
        return $this->infosPersos;
    }

    public function addInfosPerso(InfosPerso $infosPerso): self
    {
        if (!$this->infosPersos->contains($infosPerso)) {
            $this->infosPersos[] = $infosPerso;
            $infosPerso->setIdCv($this);
        }

        return $this;
    }

    public function removeInfosPerso(InfosPerso $infosPerso): self
    {
        if ($this->infosPersos->removeElement($infosPerso)) {
            // set the owning side to null (unless already changed)
            if ($infosPerso->getIdCv() === $this) {
                $infosPerso->setIdCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ContactInformation[]
     */
    public function getContactInformation(): Collection
    {
        return $this->contactInformation;
    }

    public function addContactInformation(ContactInformation $contactInformation): self
    {
        if (!$this->contactInformation->contains($contactInformation)) {
            $this->contactInformation[] = $contactInformation;
            $contactInformation->setIdCv($this);
        }

        return $this;
    }

    public function removeContactInformation(ContactInformation $contactInformation): self
    {
        if ($this->contactInformation->removeElement($contactInformation)) {
            // set the owning side to null (unless already changed)
            if ($contactInformation->getIdCv() === $this) {
                $contactInformation->setIdCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skills[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setIdCv($this);
        }

        return $this;
    }

    public function removeSkill(Skills $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getIdCv() === $this) {
                $skill->setIdCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProfessionalCourse[]
     */
    public function getProfessionalCourses(): Collection
    {
        return $this->professionalCourses;
    }

    public function addProfessionalCourse(ProfessionalCourse $professionalCourse): self
    {
        if (!$this->professionalCourses->contains($professionalCourse)) {
            $this->professionalCourses[] = $professionalCourse;
            $professionalCourse->setIdCv($this);
        }

        return $this;
    }

    public function removeProfessionalCourse(ProfessionalCourse $professionalCourse): self
    {
        if ($this->professionalCourses->removeElement($professionalCourse)) {
            // set the owning side to null (unless already changed)
            if ($professionalCourse->getIdCv() === $this) {
                $professionalCourse->setIdCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
            $training->setIdCv($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): self
    {
        if ($this->trainings->removeElement($training)) {
            // set the owning side to null (unless already changed)
            if ($training->getIdCv() === $this) {
                $training->setIdCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CenterInterest[]
     */
    public function getCenterInterests(): Collection
    {
        return $this->centerInterests;
    }

    public function addCenterInterest(CenterInterest $centerInterest): self
    {
        if (!$this->centerInterests->contains($centerInterest)) {
            $this->centerInterests[] = $centerInterest;
            $centerInterest->setIdCv($this);
        }

        return $this;
    }

    public function removeCenterInterest(CenterInterest $centerInterest): self
    {
        if ($this->centerInterests->removeElement($centerInterest)) {
            // set the owning side to null (unless already changed)
            if ($centerInterest->getIdCv() === $this) {
                $centerInterest->setIdCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Certificate[]
     */
    public function getCertificates(): Collection
    {
        return $this->certificates;
    }

    public function addCertificate(Certificate $certificate): self
    {
        if (!$this->certificates->contains($certificate)) {
            $this->certificates[] = $certificate;
            $certificate->setIdCv($this);
        }

        return $this;
    }

    public function removeCertificate(Certificate $certificate): self
    {
        if ($this->certificates->removeElement($certificate)) {
            // set the owning side to null (unless already changed)
            if ($certificate->getIdCv() === $this) {
                $certificate->setIdCv(null);
            }
        }

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
    
    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getLangues(): Collection
    {
        return $this->langues;
    }

    public function addLangue(Langue $langue): self
    {
        if (!$this->langues->contains($langue)) {
            $this->langues[] = $langue;
            $langue->setIdCv($this);
        }

        return $this;
    }

    public function removeLangue(Langue $langue): self
    {
        if ($this->langues->removeElement($langue)) {
            // set the owning side to null (unless already changed)
            if ($langue->getIdCv() === $this) {
                $langue->setIdCv(null);
            }
        }

        return $this;
    }
}
