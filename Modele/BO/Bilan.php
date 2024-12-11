<?php

namespace BO;

class Bilan{
    protected int $idBil;

    protected float $notDos;
    protected float $notOral;
    protected  string $rema;

    protected ?Etudiant $monEtu;

    public function __construct(int $idBil, float $notDos, float $notOral,string $rema, ?Etudiant $monEtu)
    {
        $this->idBil = $idBil;
        $this->notDos = $notDos;
        $this->notOral = $notOral;
        $this->rema = $rema;
        $this->monEtu = $monEtu;
    }

    public function getIdBil(): int
    {
        return $this->idBil;
    }

    public function setIdBil(int $idBil): void
    {
        $this->idBil = $idBil;
    }

    public function getNotDos(): float
    {
        return $this->notDos;
    }

    public function setNotDos(float $notDos): void
    {
        $this->notDos = $notDos;
    }

    public function getNotOral(): float
    {
        return $this->notOral;
    }

    public function setNotOral(float $notOral): void
    {
        $this->notOral = $notOral;
    }
    public function getRema(): string
    {
        return $this->rema;
    }

    public function setRema(string $rema): void
    {
        $this->rema = $rema;
    }

    public function getMonEtu(): ?Etudiant
    {
        return $this->monEtu;
    }

    public function setMonEtu(?Etudiant $monEtu): void
    {
        $this->monEtu = $monEtu;
    }



}