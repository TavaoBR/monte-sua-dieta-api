<?php

namespace App\Entity;

use App\Repository\PadraoAlimentarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PadraoAlimentarRepository::class)]
class PadraoAlimentar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Usuarios $UsuarioId = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $DietaEspecifica = null;

    #[ORM\Column(nullable: true)]
    private ?array $RestricaoAlimentar = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $PreferenciaAlimentar = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDietaEspecifica(): ?string
    {
        return $this->DietaEspecifica;
    }

    public function setDietaEspecifica(?string $DietaEspecifica): static
    {
        $this->DietaEspecifica = $DietaEspecifica;

        return $this;
    }

    public function getUsuarioId(): ?Usuarios
    {
        return $this->UsuarioId;
    }

    public function setUsuarioId(?Usuarios $UsuarioId): static
    {
        $this->UsuarioId = $UsuarioId;

        return $this;
    }

    public function getRestricaoAlimentar(): ?array
    {
        return $this->RestricaoAlimentar;
    }

    public function setRestricaoAlimentar(?array $RestricaoAlimentar): static
    {
        $this->RestricaoAlimentar = $RestricaoAlimentar;

        return $this;
    }

    public function getPreferenciaAlimentar(): ?string
    {
        return $this->PreferenciaAlimentar;
    }

    public function setPreferenciaAlimentar(?string $PreferenciaAlimentar): static
    {
        $this->PreferenciaAlimentar = $PreferenciaAlimentar;

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
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $UpdatedAt): static
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }
}
