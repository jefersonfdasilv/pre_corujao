<?php

namespace App\Entity;

use App\Repository\PessoaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PessoaRepository::class)
 */
class Pessoa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $nome;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $dataNascimento;

    /**
     * @ORM\Column(type="string", length=18, nullable=true)
     */
    private string $telefone;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private string $email;

    /**
     * @ORM\OneToMany(targetEntity=Inscricao::class, mappedBy="pessoa")
     */
    private Collection $inscricoes;

    public function __construct()
    {
        $this->inscricoes = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = ucwords(trim($nome));

        return $this;
    }

    public function getDataNascimento(): \DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Inscricao[]
     */
    public function getInscricoes(): Collection
    {
        return $this->inscricoes;
    }

    public function addInscrito(Inscricao $inscrito): self
    {
        if (!$this->inscricoes->contains($inscrito)) {
            $this->inscricoes[] = $inscrito;
            $inscrito->setPessoa($this);
        }

        return $this;
    }

    public function removeInscrito(Inscricao $inscrito): self
    {
        if ($this->inscricoes->removeElement($inscrito)) {
            // set the owning side to null (unless already changed)
            if ($inscrito->getPessoa() === $this) {
                $inscrito->setPessoa(null);
            }
        }

        return $this;
    }
}
