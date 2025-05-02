<?php

namespace App\Entity;

use App\Repository\FichaTreinoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FichaTreinoRepository::class)]
class FichaTreino
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fichaTreinos')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $Token = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Experiencia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Dificuldade = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Observacoes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NomeFicha = null;

    #[ORM\Column(nullable: true)]
    private ?float $PontosUsados = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, ExerciciosFicha>
     */
    #[ORM\OneToMany(targetEntity: ExerciciosFicha::class, mappedBy: 'IdFicha')]
    private Collection $exerciciosFichas;

    public function __construct()
    {
        $this->exerciciosFichas = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuario(): ?Usuarios
    {
        return $this->IdUsuario;
    }

    public function setIdUsuario(?Usuarios $IdUsuario): static
    {
        $this->IdUsuario = $IdUsuario;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->Token;
    }

    public function setToken(?string $Token): static
    {
        $this->Token = $Token;

        return $this;
    }

    public function getExperiencia(): ?string
    {
        return $this->Experiencia;
    }

    public function setExperiencia(?string $Experiencia): static
    {
        $this->Experiencia = $Experiencia;

        return $this;
    }

    public function getDificuldade(): ?string
    {
        return $this->Dificuldade;
    }

    public function setDificuldade(?string $Dificuldade): static
    {
        $this->Dificuldade = $Dificuldade;

        return $this;
    }

    public function getObservacoes(): ?string
    {
        return $this->Observacoes;
    }

    public function setObservacoes(?string $Observacoes): static
    {
        $this->Observacoes = $Observacoes;

        return $this;
    }

    public function getNomeFicha(): ?string
    {
        return $this->NomeFicha;
    }

    public function setNomeFicha(?string $NomeFicha): static
    {
        $this->NomeFicha = $NomeFicha;

        return $this;
    }

    public function getPontosUsados(): ?float
    {
        return $this->PontosUsados;
    }

    public function setPontosUsados(?float $PontosUsados): static
    {
        $this->PontosUsados = $PontosUsados;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): static
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, ExerciciosFicha>
     */
    public function getExerciciosFichas(): Collection
    {
        return $this->exerciciosFichas;
    }

    public function addExerciciosFicha(ExerciciosFicha $exerciciosFicha): static
    {
        if (!$this->exerciciosFichas->contains($exerciciosFicha)) {
            $this->exerciciosFichas->add($exerciciosFicha);
            $exerciciosFicha->setIdFicha($this);
        }

        return $this;
    }

    public function removeExerciciosFicha(ExerciciosFicha $exerciciosFicha): static
    {
        if ($this->exerciciosFichas->removeElement($exerciciosFicha)) {
            // set the owning side to null (unless already changed)
            if ($exerciciosFicha->getIdFicha() === $this) {
                $exerciciosFicha->setIdFicha(null);
            }
        }

        return $this;
    }




}
