<?php

namespace App\Entity;

use App\Repository\PessoaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PessoaRepository::class)]
class Pessoa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Usuarios $IdUsuario = null;

    #[ORM\Column(length: 255)]
    #[Groups(['default'])]
    private ?string $Nome = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['default'])]
    private ?string $Sobrenome = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?int $Idade = null;

    #[ORM\Column(length: 1, nullable: true)]
    #[Groups(['default'])]
    private ?string $Sexo = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2, nullable: true)]
    #[Groups(['default'])]
    private ?string $Altura = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    #[Groups(['default'])]
    private ?string $Peso = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;


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

    public function getNome(): ?string
    {
        return $this->Nome;
    }

    public function setNome(string $Nome): static
    {
        $this->Nome = $Nome;

        return $this;
    }

    public function getSobrenome(): ?string
    {
        return $this->Sobrenome;
    }

    public function setSobrenome(?string $Sobrenome): static
    {
        $this->Sobrenome = $Sobrenome;

        return $this;
    }

    public function getIdade(): ?int
    {
        return $this->Idade;
    }

    public function setIdade(?int $Idade): static
    {
        $this->Idade = $Idade;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->Sexo;
    }

    public function setSexo(?string $Sexo): static
    {
        $this->Sexo = $Sexo;

        return $this;
    }

    public function getAltura(): ?string
    {
        return $this->Altura;
    }

    public function setAltura(?string $Altura): static
    {
        $this->Altura = $Altura;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->Peso;
    }

    public function setPeso(?string $Peso): static
    {
        $this->Peso = $Peso;

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
