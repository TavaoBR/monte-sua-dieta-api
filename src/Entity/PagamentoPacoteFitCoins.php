<?php

namespace App\Entity;

use App\Repository\PagamentoPacoteFitCoinsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PagamentoPacoteFitCoinsRepository::class)]
class PagamentoPacoteFitCoins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pagamentoPacoteFitCoins')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\ManyToOne(inversedBy: 'pagamentoPacoteFitCoins')]
    private ?PacotesFitCoins $IdFitCoins = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MetodoPagamento = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $CorrelationId = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $IdPagamentoMercadoPago = null;

    #[ORM\Column(nullable: true)]
    private ?array $MetadataJson = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $Status = "pending";

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $GatwayUsado = "Mercado Pago API";

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

    public function getIdFitCoins(): ?PacotesFitCoins
    {
        return $this->IdFitCoins;
    }

    public function setIdFitCoins(?PacotesFitCoins $IdFitCoins): static
    {
        $this->IdFitCoins = $IdFitCoins;

        return $this;
    }

    public function getMetodoPagamento(): ?string
    {
        return $this->MetodoPagamento;
    }

    public function setMetodoPagamento(?string $MetodoPagamento): static
    {
        $this->MetodoPagamento = $MetodoPagamento;

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

    public function getIdPagamentoMercadoPago(): ?string
    {
        return $this->IdPagamentoMercadoPago;
    }

    public function setIdPagamentoMercadoPago(?string $IdPagamentoMercadoPago): static
    {
        $this->IdPagamentoMercadoPago = $IdPagamentoMercadoPago;

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

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): static
    {
        $this->Status = $Status;

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

    public function getGatwayUsado(): ?string
    {
        return $this->GatwayUsado;
    }

    public function setGatwayUsado(?string $GatwayUsado): static
    {
        $this->GatwayUsado = $GatwayUsado;

        return $this;
    }
}
