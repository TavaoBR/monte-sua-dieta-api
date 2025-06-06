<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UsuariosRepository::class)]
class Usuarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['default'])]
    private ?string $NomeUsuario = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['default'])]
    private ?string $Email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Senha = null;

    #[ORM\Column(length: 999, nullable: true)]
    private ?string $Token = null;

    #[ORM\Column(length: 100000, nullable: true)]
    #[Groups(['default'])]
    private ?string $Avatar = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    #[Groups(['default'])]
    private ?int $Credito = 1000;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $Tentativas = 0;

    /**
     * @var Collection<int, TreinoInteligente>
     */
    
    #[Ignore]
    #[ORM\OneToMany(targetEntity: TreinoInteligente::class, mappedBy: 'IdUsuario')]
    private Collection $treinoInteligentes;


    /**
     * @var Collection<int, PagamentoPacoteFitCoins>
     */
    #[Ignore]
    #[ORM\OneToMany(targetEntity: PagamentoPacoteFitCoins::class, mappedBy: 'IdUsuario')]
    private Collection $pagamentoPacoteFitCoins;

    /**
     * @var Collection<int, GrupoMuscularPrioritario>
     */
    #[Ignore]
    #[ORM\OneToMany(targetEntity: GrupoMuscularPrioritario::class, mappedBy: 'IdUsuario')]
    private Collection $grupoMuscularPrioritarios;

    /**
     * @var Collection<int, ListaExercicios>
     */
    #[Ignore]
    #[ORM\OneToMany(targetEntity: ListaExercicios::class, mappedBy: 'IdUsuario')]
    private Collection $listaExercicios;

    /**
     * @var Collection<int, FichaTreino>
     */
    #[Ignore]
    #[ORM\OneToMany(targetEntity: FichaTreino::class, mappedBy: 'IdUsuario')]
    private Collection $fichaTreinos;

    /**
     * @var Collection<int, PerfilNutricional>
     */
    #[ORM\OneToMany(targetEntity: PerfilNutricional::class, mappedBy: 'IdUsuario')]
    private Collection $perfilNutricionals;

    /**
     * @var Collection<int, PlanoAlimentar>
     */
    #[ORM\OneToMany(targetEntity: PlanoAlimentar::class, mappedBy: 'IdUsuario')]
    private Collection $planoAlimentars;

    public function __construct()
    {
        $this->treinoInteligentes = new ArrayCollection();
        $this->pagamentoPacoteFitCoins = new ArrayCollection();
        $this->grupoMuscularPrioritarios = new ArrayCollection();
        $this->listaExercicios = new ArrayCollection();
        $this->fichaTreinos = new ArrayCollection();
        $this->perfilNutricionals = new ArrayCollection();
        $this->planoAlimentars = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, TreinoInteligente>
     */
    public function getTreinoInteligentes(): Collection
    {
        return $this->treinoInteligentes;
    }

    public function addTreinoInteligente(TreinoInteligente $treinoInteligente): static
    {
        if (!$this->treinoInteligentes->contains($treinoInteligente)) {
            $this->treinoInteligentes->add($treinoInteligente);
            $treinoInteligente->setIdUsuario($this);
        }

        return $this;
    }

    public function removeTreinoInteligente(TreinoInteligente $treinoInteligente): static
    {
        if ($this->treinoInteligentes->removeElement($treinoInteligente)) {
            // set the owning side to null (unless already changed)
            if ($treinoInteligente->getIdUsuario() === $this) {
                $treinoInteligente->setIdUsuario(null);
            }
        }

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
            $pagamentoPacoteFitCoin->setIdUsuario($this);
        }

        return $this;
    }

    public function removePagamentoPacoteFitCoin(PagamentoPacoteFitCoins $pagamentoPacoteFitCoin): static
    {
        if ($this->pagamentoPacoteFitCoins->removeElement($pagamentoPacoteFitCoin)) {
            // set the owning side to null (unless already changed)
            if ($pagamentoPacoteFitCoin->getIdUsuario() === $this) {
                $pagamentoPacoteFitCoin->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GrupoMuscularPrioritario>
     */
    public function getGrupoMuscularPrioritarios(): Collection
    {
        return $this->grupoMuscularPrioritarios;
    }

    public function addGrupoMuscularPrioritario(GrupoMuscularPrioritario $grupoMuscularPrioritario): static
    {
        if (!$this->grupoMuscularPrioritarios->contains($grupoMuscularPrioritario)) {
            $this->grupoMuscularPrioritarios->add($grupoMuscularPrioritario);
            $grupoMuscularPrioritario->setIdUsuario($this);
        }

        return $this;
    }

    public function removeGrupoMuscularPrioritario(GrupoMuscularPrioritario $grupoMuscularPrioritario): static
    {
        if ($this->grupoMuscularPrioritarios->removeElement($grupoMuscularPrioritario)) {
            // set the owning side to null (unless already changed)
            if ($grupoMuscularPrioritario->getIdUsuario() === $this) {
                $grupoMuscularPrioritario->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ListaExercicios>
     */
    public function getListaExercicios(): Collection
    {
        return $this->listaExercicios;
    }

    public function addListaExercicio(ListaExercicios $listaExercicio): static
    {
        if (!$this->listaExercicios->contains($listaExercicio)) {
            $this->listaExercicios->add($listaExercicio);
            $listaExercicio->setIdUsuario($this);
        }

        return $this;
    }

    public function removeListaExercicio(ListaExercicios $listaExercicio): static
    {
        if ($this->listaExercicios->removeElement($listaExercicio)) {
            // set the owning side to null (unless already changed)
            if ($listaExercicio->getIdUsuario() === $this) {
                $listaExercicio->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FichaTreino>
     */
    public function getFichaTreinos(): Collection
    {
        return $this->fichaTreinos;
    }

    public function addFichaTreino(FichaTreino $fichaTreino): static
    {
        if (!$this->fichaTreinos->contains($fichaTreino)) {
            $this->fichaTreinos->add($fichaTreino);
            $fichaTreino->setIdUsuario($this);
        }

        return $this;
    }

    public function removeFichaTreino(FichaTreino $fichaTreino): static
    {
        if ($this->fichaTreinos->removeElement($fichaTreino)) {
            // set the owning side to null (unless already changed)
            if ($fichaTreino->getIdUsuario() === $this) {
                $fichaTreino->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PerfilNutricional>
     */
    public function getPerfilNutricionals(): Collection
    {
        return $this->perfilNutricionals;
    }

    public function addPerfilNutricional(PerfilNutricional $perfilNutricional): static
    {
        if (!$this->perfilNutricionals->contains($perfilNutricional)) {
            $this->perfilNutricionals->add($perfilNutricional);
            $perfilNutricional->setIdUsuario($this);
        }

        return $this;
    }

    public function removePerfilNutricional(PerfilNutricional $perfilNutricional): static
    {
        if ($this->perfilNutricionals->removeElement($perfilNutricional)) {
            // set the owning side to null (unless already changed)
            if ($perfilNutricional->getIdUsuario() === $this) {
                $perfilNutricional->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlanoAlimentar>
     */
    public function getPlanoAlimentars(): Collection
    {
        return $this->planoAlimentars;
    }

    public function addPlanoAlimentar(PlanoAlimentar $planoAlimentar): static
    {
        if (!$this->planoAlimentars->contains($planoAlimentar)) {
            $this->planoAlimentars->add($planoAlimentar);
            $planoAlimentar->setIdUsuario($this);
        }

        return $this;
    }

    public function removePlanoAlimentar(PlanoAlimentar $planoAlimentar): static
    {
        if ($this->planoAlimentars->removeElement($planoAlimentar)) {
            // set the owning side to null (unless already changed)
            if ($planoAlimentar->getIdUsuario() === $this) {
                $planoAlimentar->setIdUsuario(null);
            }
        }

        return $this;
    }
}
