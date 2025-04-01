<?php

namespace App\Entity;

use App\Repository\LoginSessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoginSessionRepository::class)]
class LoginSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $UsuarioId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $LoginDateTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ExpireDateTime = null;

    #[ORM\Column(length: 100000, nullable: true)]
    private ?string $SessionMetadataJson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuarioId(): ?string
    {
        return $this->UsuarioId;
    }

    public function setUsuarioId(?string $UsuarioId): static
    {
        $this->UsuarioId = $UsuarioId;

        return $this;
    }

    public function getLoginDateTime(): ?\DateTimeInterface
    {
        return $this->LoginDateTime;
    }

    public function setLoginDateTime(?\DateTimeInterface $LoginDateTime): static
    {
        $this->LoginDateTime = $LoginDateTime;

        return $this;
    }

    public function getExpireDateTime(): ?\DateTimeInterface
    {
        return $this->ExpireDateTime;
    }

    public function setExpireDateTime(?\DateTimeInterface $ExpireDateTime): static
    {
        $this->ExpireDateTime = $ExpireDateTime;

        return $this;
    }

    public function getSessionMetadataJson(): ?string
    {
        return $this->SessionMetadataJson;
    }

    public function setSessionMetadataJson(?string $SessionMetadataJson): static
    {
        $this->SessionMetadataJson = $SessionMetadataJson;

        return $this;
    }
}
