<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreHeures;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbreHeureFait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $semestre;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="cours")
     */
    private $professeur;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity=AnneeScolaire::class, inversedBy="cours")
     */
    private $anneeScolaire;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, mappedBy="cours")
     */
    private $classes;

    /**
     * @ORM\OneToMany(targetEntity=Seance::class, mappedBy="cours")
     */
    private $seances;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->seances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbreHeure(): ?int
    {
        return $this->nbreHeures;
    }

    public function setNbreHeure(int $nbreHeures): self
    {
        $this->nbreHeures = $nbreHeures;

        return $this;
    }

    public function getNbreHeureFait(): ?int
    {
        return $this->nbreHeureFait;
    }

    public function setNbreHeureFait(?int $nbreHeureFait): self
    {
        $this->nbreHeureFait = $nbreHeureFait;

        return $this;
    }

    public function getSemestre(): ?string
    {
        return $this->semestre;
    }

    public function setSemestre(string $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getAnneeScolaire(): ?AnneeScolaire
    {
        return $this->anneeScolaire;
    }

    public function setAnneeScolaire(?AnneeScolaire $anneeScolaire): self
    {
        $this->anneeScolaire = $anneeScolaire;

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->addCour($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            $class->removeCour($this);
        }

        return $this;
    }

    /**
     * @return Collection|Seance[]
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seances->contains($seance)) {
            $this->seances[] = $seance;
            $seance->setCours($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getCours() === $this) {
                $seance->setCours(null);
            }
        }

        return $this;
    }
}
