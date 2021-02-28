<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventoRepository::class)
 */
class Evento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $descricao;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $dataInicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $dataFim;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $cidade;

    /**
     * @ORM\OneToMany(targetEntity=Inscricao::class, mappedBy="evento")
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
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDataInicio(): ?\DateTimeInterface
    {
        return $this->dataInicio;
    }

    public function setDataInicio(\DateTimeInterface $dataInicio): self
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    public function getDataFim(): \DateTimeInterface
    {
        return $this->dataFim;
    }

    public function setDataFim(\DateTimeInterface $dataFim): self
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * @return Collection|Inscricao[]
     */
    public function getInscricoes(): Collection
    {
        return $this->inscricoes;
    }

    public function addInscricao(Inscricao $inscricao): self
    {
        if (!$this->inscricoes->contains($inscricao)) {
            $this->inscricoes[] = $inscricao;
            $inscricao->setEvento($this);
        }

        return $this;
    }

    public function removeInscricao(Inscricao $inscricao): self
    {
        if ($this->inscricoes->removeElement($inscricao)) {
            // set the owning side to null (unless already changed)
            if ($inscricao->getEvento() === $this) {
                $inscricao->setEvento(null);
            }
        }

        return $this;
    }
}
