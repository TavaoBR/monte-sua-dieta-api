<?php

namespace App\Entity;

use App\Repository\PlanoAlimentarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlanoAlimentarRepository::class)]
class PlanoAlimentar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['default'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'planoAlimentars')]
    private ?Usuarios $IdUsuario = null;

    #[ORM\Column(length: 999, nullable: true)]
    #[Groups(['default'])]
    private ?string $NomePlano = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?array $Refeicoes = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?array $TotaisDiarios = null;

    #[ORM\Column(length: 20000, nullable: true)]
    #[Groups(['default'])]
    private ?string $SugestaoMelhoria = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 999, nullable: true)]
    #[Groups(['default'])]
    private ?string $Token = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['default'])]
    private ?int $PontosUsados = null;

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

    public function getNomePlano(): ?string
    {
        return $this->NomePlano;
    }

    public function setNomePlano(?string $NomePlano): static
    {
        $this->NomePlano = $NomePlano;

        return $this;
    }

    public function getRefeicoes(): ?array
    {
        return $this->Refeicoes;
    }

    public function setRefeicoes(?array $Refeicoes): static
    {
        $this->Refeicoes = $Refeicoes;

        return $this;
    }

    public function getTotaisDiarios(): ?array
    {
        return $this->TotaisDiarios;
    }

    public function setTotaisDiarios(?array $TotaisDiarios): static
    {
        $this->TotaisDiarios = $TotaisDiarios;

        return $this;
    }

    public function getSugestaoMelhoria(): ?string
    {
        return $this->SugestaoMelhoria;
    }

    public function setSugestaoMelhoria(?string $SugestaoMelhoria): static
    {
        $this->SugestaoMelhoria = $SugestaoMelhoria;

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

    public function getPontosUsados(): ?int
    {
        return $this->PontosUsados;
    }

    public function setPontosUsados(?int $PontosUsados): static
    {
        $this->PontosUsados = $PontosUsados;

        return $this;
    }
}
