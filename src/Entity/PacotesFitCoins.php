<?php

namespace App\Entity;

use App\Repository\PacotesFitCoinsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PacotesFitCoinsRepository::class)]
class PacotesFitCoins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Titulo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Descricao = null;

    #[ORM\Column(nullable: true)]
    private ?float $Valor = null;

    #[ORM\Column(nullable: true)]
    private ?int $QtdCoins = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->Titulo;
    }

    public function setTitulo(?string $Titulo): static
    {
        $this->Titulo = $Titulo;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->Descricao;
    }

    public function setDescricao(?string $Descricao): static
    {
        $this->Descricao = $Descricao;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->Valor;
    }

    public function setValor(?float $Valor): static
    {
        $this->Valor = $Valor;

        return $this;
    }

    public function getQtdCoins(): ?int
    {
        return $this->QtdCoins;
    }

    public function setQtdCoins(?int $QtdCoins): static
    {
        $this->QtdCoins = $QtdCoins;

        return $this;
    }
}
