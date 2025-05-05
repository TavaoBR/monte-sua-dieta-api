<?php

namespace App\Entity;

use App\Repository\PerfilNutricionalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilNutricionalRepository::class)]
class PerfilNutricional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'perfilNutricionals')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $Objetivo = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $NivelAtividade = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $PreferenciasAlimentares = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $CondicoesMedica = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $RestricoesAlimentares = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $Alergias = null;

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

    public function getObjetivo(): ?string
    {
        return $this->Objetivo;
    }

    public function setObjetivo(?string $Objetivo): static
    {
        $this->Objetivo = $Objetivo;

        return $this;
    }

    public function getNivelAtividade(): ?string
    {
        return $this->NivelAtividade;
    }

    public function setNivelAtividade(?string $NivelAtividade): static
    {
        $this->NivelAtividade = $NivelAtividade;

        return $this;
    }

    public function getPreferenciasAlimentares(): ?string
    {
        return $this->PreferenciasAlimentares;
    }

    public function setPreferenciasAlimentares(string $PreferenciasAlimentares): static
    {
        $this->PreferenciasAlimentares = $PreferenciasAlimentares;

        return $this;
    }

    public function getCondicoesMedica(): ?string
    {
        return $this->CondicoesMedica;
    }

    public function setCondicoesMedica(?string $CondicoesMedica): static
    {
        $this->CondicoesMedica = $CondicoesMedica;

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

    public function getRestricoesAlimentares(): ?string
    {
        return $this->RestricoesAlimentares;
    }

    public function setRestricoesAlimentares(?string $RestricoesAlimentares): static
    {
        $this->RestricoesAlimentares = $RestricoesAlimentares;

        return $this;
    }

    public function getAlergias(): ?string
    {
        return $this->Alergias;
    }

    public function setAlergias(?string $Alergias): static
    {
        $this->Alergias = $Alergias;

        return $this;
    }
}
