<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuariosRepository::class)]
class Usuarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NomeUsuario = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Senha = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $Token = null;

    #[ORM\Column(length: 100000, nullable: true)]
    private ?string $Avatar = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $Credito = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $Tentativas = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeUsuario(): ?string
    {
        return $this->NomeUsuario;
    }

    public function setNomeUsuario(?string $NomeUsuario): static
    {
        $this->NomeUsuario = $NomeUsuario;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->Senha;
    }

    public function setSenha(?string $Senha): static
    {
        $this->Senha = $Senha;

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

    public function getAvatar(): ?string
    {
        return $this->Avatar;
    }

    public function setAvatar(?string $Avatar): static
    {
        $this->Avatar = $Avatar;

        return $this;
    }

    public function getCredito(): ?string
    {
        return $this->Credito;
    }

    public function setCredito(?string $Credito): static
    {
        $this->Credito = $Credito;

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

    public function getTentativas(): ?int
    {
        return $this->Tentativas;
    }

    public function setTentativas(int $Tentativas): static
    {
        $this->Tentativas = $Tentativas;

        return $this;
    }
}
