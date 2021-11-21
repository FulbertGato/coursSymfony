<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAt;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $heureFime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStatut;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="seances")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity=Absence::class, mappedBy="seance")
     */
    private $absences;

    public function __construct()
    {
        $this->absences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeInterface $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getHeureDebut(): ?string
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(string $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFime(): ?string
    {
        return $this->heureFime;
    }

    public function setHeureFime(string $heureFime): self
    {
        $this->heureFime = $heureFime;

        return $this;
    }

    public function getIsStatut(): ?bool
    {
        return $this->isStatut;
    }

    public function setIsStatut(bool $isStatut): self
    {
        $this->isStatut = $isStatut;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * @return Collection|Absence[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setSeance($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getSeance() === $this) {
                $absence->setSeance(null);
            }
        }

        return $this;
    }
}
