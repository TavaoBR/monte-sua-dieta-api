<?php

namespace App\Entity;

use App\Repository\PaymentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentsRepository::class)]
class Payments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'payments')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Metodo = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $CorrelationId = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $MPrefId = null;

    #[ORM\Column(nullable: true)]
    private ?array $MetadataJson = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Status = 'pedding';

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

    public function getMetodo(): ?string
    {
        return $this->Metodo;
    }

    public function setMetodo(string $Metodo): static
    {
        $this->Metodo = $Metodo;

        return $this;
    }

    public function getCorrelationId(): ?string
    {
        return $this->CorrelationId;
    }

    public function setCorrelationId(?string $CorrelationId): static
    {
        $this->CorrelationId = $CorrelationId;

        return $this;
    }

    public function getMPrefId(): ?string
    {
        return $this->MPrefId;
    }

    public function setMPrefId(?string $MPrefId): static
    {
        $this->MPrefId = $MPrefId;

        return $this;
    }

    public function getMetadataJson(): ?array
    {
        return $this->MetadataJson;
    }

    public function setMetadataJson(?array $MetadataJson): static
    {
        $this->MetadataJson = $MetadataJson;

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

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): static
    {
        $this->Status = $Status;

        return $this;
    }
}
