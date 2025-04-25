<?php

namespace App\Entity;

use App\Repository\PacotesFitCoinsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

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

    /**
     * @var Collection<int, PagamentoPacoteFitCoins>
     */
    #[Ignore]
    #[ORM\OneToMany(targetEntity: PagamentoPacoteFitCoins::class, mappedBy: 'IdFitCoins')]
    private Collection $pagamentoPacoteFitCoins;

    public function __construct()
    {
        $this->pagamentoPacoteFitCoins = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, PagamentoPacoteFitCoins>
     */
    public function getPagamentoPacoteFitCoins(): Collection
    {
        return $this->pagamentoPacoteFitCoins;
    }

    public function addPagamentoPacoteFitCoin(PagamentoPacoteFitCoins $pagamentoPacoteFitCoin): static
    {
        if (!$this->pagamentoPacoteFitCoins->contains($pagamentoPacoteFitCoin)) {
            $this->pagamentoPacoteFitCoins->add($pagamentoPacoteFitCoin);
            $pagamentoPacoteFitCoin->setIdFitCoins($this);
        }

        return $this;
    }

    public function removePagamentoPacoteFitCoin(PagamentoPacoteFitCoins $pagamentoPacoteFitCoin): static
    {
        if ($this->pagamentoPacoteFitCoins->removeElement($pagamentoPacoteFitCoin)) {
            // set the owning side to null (unless already changed)
            if ($pagamentoPacoteFitCoin->getIdFitCoins() === $this) {
                $pagamentoPacoteFitCoin->setIdFitCoins(null);
            }
        }

        return $this;
    }
}
