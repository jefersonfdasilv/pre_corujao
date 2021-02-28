<?php

namespace App\Entity;

use App\Repository\InscricaoRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=InscricaoRepository::class)
 */
class Inscricao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Evento::class, inversedBy="inscricoes")
     * @ORM\JoinColumn(nullable=false)
     */
    private Evento $evento;

    /**
     * @ORM\ManyToOne(targetEntity=Pessoa::class, inversedBy="inscricoes")
     * @ORM\JoinColumn(nullable=false)
     */
    private Pessoa $pessoa;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $dataInscricao;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $identificadorUnico;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;

    public function __construct()
    {
        $this->identificadorUnico = Uuid::uuid4()->toString();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEvento(): Evento
    {
        return $this->evento;
    }

    public function setEvento(Evento $evento): self
    {
        $this->evento = $evento;

        return $this;
    }

    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    public function getDataInscricao(): \DateTimeInterface
    {
        return $this->dataInscricao;
    }

    public function setDataInscricao(\DateTimeInterface $dataInscricao): self
    {
        $this->dataInscricao = $dataInscricao;

        return $this;
    }

    public function getIdentificadorUnico(): string
    {
        return $this->identificadorUnico;
    }

    public function setIdentificadorUnico(string $identificadorUnico): self
    {
        $this->identificadorUnico = $identificadorUnico;

        return $this;
    }

    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }
}
