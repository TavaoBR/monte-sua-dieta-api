<?php

namespace App\Entity;

use App\Repository\ListaExerciciosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ListaExerciciosRepository::class)]
class ListaExercicios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['default'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listaExercicios')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\ManyToOne(inversedBy: 'listaExercicios')]
    private ?GrupoMuscularPrioritario $IdGMP = null;

    #[ORM\Column(length: 999, nullable: true)]
    #[Groups(['default'])]
    private ?string $Exercicio = null;

    #[ORM\Column(length: 999, nullable: true)]
    #[Groups(['default'])]
    private ?string $musculoAtivado = null;

    #[ORM\Column(length: 999, nullable: true)]
    #[Groups(['default'])]
    private ?string $Equipamento = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?int $Series = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?int $Repeticoes = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['default'])]
    private ?string $Dificuldade = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['default'])]
    private ?string $Token = null;

    #[ORM\Column]
    #[Groups(['default'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['default'])]
    private ?string $ComoExecutar = null;

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

    public function getIdGMP(): ?GrupoMuscularPrioritario
    {
        return $this->IdGMP;
    }

    public function setIdGMP(?GrupoMuscularPrioritario $IdGMP): static
    {
        $this->IdGMP = $IdGMP;

        return $this;
    }

    public function getExercicio(): ?string
    {
        return $this->Exercicio;
    }

    public function setExercicio(?string $Exercicio): static
    {
        $this->Exercicio = $Exercicio;

        return $this;
    }

    public function getMusculoAtivado(): ?string
    {
        return $this->musculoAtivado;
    }

    public function setMusculoAtivado(?string $musculoAtivado): static
    {
        $this->musculoAtivado = $musculoAtivado;

        return $this;
    }

    public function getEquipamento(): ?string
    {
        return $this->Equipamento;
    }

    public function setEquipamento(?string $Equipamento): static
    {
        $this->Equipamento = $Equipamento;

        return $this;
    }

    public function getSeries(): ?int
    {
        return $this->Series;
    }

    public function setSeries(?int $Series): static
    {
        $this->Series = $Series;

        return $this;
    }

    public function getRepeticoes(): ?int
    {
        return $this->Repeticoes;
    }

    public function setRepeticoes(?int $Repeticoes): static
    {
        $this->Repeticoes = $Repeticoes;

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

    public function getToken(): ?string
    {
        return $this->Token;
    }

    public function setToken(?string $Token): static
    {
        $this->Token = $Token;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getComoExecutar(): ?string
    {
        return $this->ComoExecutar;
    }

    public function setComoExecutar(?string $ComoExecutar): static
    {
        $this->ComoExecutar = $ComoExecutar;

        return $this;
    }
}
