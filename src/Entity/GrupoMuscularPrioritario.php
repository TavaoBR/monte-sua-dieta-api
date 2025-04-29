<?php

namespace App\Entity;

use App\Repository\GrupoMuscularPrioritarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrupoMuscularPrioritarioRepository::class)]
class GrupoMuscularPrioritario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $GrupoMuscular = null;

    #[ORM\ManyToOne(inversedBy: 'grupoMuscularPrioritarios')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nivel = null;

    #[ORM\Column(nullable: true)]
    private ?float $qtdFitCoins = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, ListaExercicios>
     */
    #[ORM\OneToMany(targetEntity: ListaExercicios::class, mappedBy: 'IdGMP')]
    private Collection $listaExercicios;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Objetivo = null;

    public function __construct()
    {
        $this->listaExercicios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrupoMuscular(): ?string
    {
        return $this->GrupoMuscular;
    }

    public function setGrupoMuscular(?string $GrupoMuscular): static
    {
        $this->GrupoMuscular = $GrupoMuscular;

        return $this;
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

    public function getNivel(): ?string
    {
        return $this->Nivel;
    }

    public function setNivel(?string $Nivel): static
    {
        $this->Nivel = $Nivel;

        return $this;
    }

    public function getQtdFitCoins(): ?float
    {
        return $this->qtdFitCoins;
    }

    public function setQtdFitCoins(?float $qtdFitCoins): static
    {
        $this->qtdFitCoins = $qtdFitCoins;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, ListaExercicios>
     */
    public function getListaExercicios(): Collection
    {
        return $this->listaExercicios;
    }

    public function addListaExercicio(ListaExercicios $listaExercicio): static
    {
        if (!$this->listaExercicios->contains($listaExercicio)) {
            $this->listaExercicios->add($listaExercicio);
            $listaExercicio->setIdGMP($this);
        }

        return $this;
    }

    public function removeListaExercicio(ListaExercicios $listaExercicio): static
    {
        if ($this->listaExercicios->removeElement($listaExercicio)) {
            // set the owning side to null (unless already changed)
            if ($listaExercicio->getIdGMP() === $this) {
                $listaExercicio->setIdGMP(null);
            }
        }

        return $this;
    }

    public function getObjetivo(): ?string
    {
        return $this->Objetivo;
    }

    public function setObjetivo(?string $Objetivo): static
    {
        $this->Objetivo = $Objetivo;

        return $this;
    }
}
