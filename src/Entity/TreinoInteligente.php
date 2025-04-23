<?php

namespace App\Entity;

use App\Repository\TreinoInteligenteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreinoInteligenteRepository::class)]
class TreinoInteligente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Objetivo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Prompt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Resultado = null;

    #[ORM\Column(nullable: true)]
    private ?int $PontosUsados = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'treinoInteligentes')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nivel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LocalTreino = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrompt(): ?string
    {
        return $this->Prompt;
    }

    public function setPrompt(?string $Prompt): static
    {
        $this->Prompt = $Prompt;

        return $this;
    }

    public function getResultado(): ?string
    {
        return $this->Resultado;
    }

    public function setResultado(?string $Resultado): static
    {
        $this->Resultado = $Resultado;

        return $this;
    }

    public function getPontosUsados(): ?int
    {
        return $this->PontosUsados;
    }

    public function setPontosUsados(?int $PontosUsados): static
    {
        $this->PontosUsados = $PontosUsados;

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

    public function getLocalTreino(): ?string
    {
        return $this->LocalTreino;
    }

    public function setLocalTreino(?string $LocalTreino): static
    {
        $this->LocalTreino = $LocalTreino;

        return $this;
    }
}
