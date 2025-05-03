<?php

namespace App\Entity;

use App\Repository\ExerciciosFichaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExerciciosFichaRepository::class)]
class ExerciciosFicha
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['default'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exerciciosFichas')]
    private ?FichaTreino $IdFicha = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['default'])]
    private ?string $DiaSemana = null;

    #[ORM\Column(length: 999, nullable: true)]
    #[Groups(['default'])]
    private ?string $GrupoMuscular = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?array $ArrayExcercicios = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['default'])]
    private ?string $Cardio = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Aquecimento = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['default'])]
    private ?string $Observacoes = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $Token = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFicha(): ?FichaTreino
    {
        return $this->IdFicha;
    }

    public function setIdFicha(?FichaTreino $IdFicha): static
    {
        $this->IdFicha = $IdFicha;

        return $this;
    }

    public function getDiaSemana(): ?string
    {
        return $this->DiaSemana;
    }

    public function setDiaSemana(?string $DiaSemana): static
    {
        $this->DiaSemana = $DiaSemana;

        return $this;
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

    public function getArrayExcercicios(): ?array
    {
        return $this->ArrayExcercicios;
    }

    public function setArrayExcercicios(?array $ArrayExcercicios): static
    {
        $this->ArrayExcercicios = $ArrayExcercicios;

        return $this;
    }

    public function getCardio(): ?string
    {
        return $this->Cardio;
    }

    public function setCardio(?string $Cardio): static
    {
        $this->Cardio = $Cardio;

        return $this;
    }

    public function getAquecimento(): ?string
    {
        return $this->Aquecimento;
    }

    public function setAquecimento(?string $Aquecimento): static
    {
        $this->Aquecimento = $Aquecimento;

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

    public function getToken(): ?string
    {
        return $this->Token;
    }

    public function setToken(?string $Token): static
    {
        $this->Token = $Token;

        return $this;
    }
}
