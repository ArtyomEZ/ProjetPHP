<?php

namespace BO;

class Classe {

    private int $idCla;
    private string $nomCla;
    private int $maxEtuCla;

    public function __construct(int $idCla, string $nomCla, int $maxEtuCla)
    {
        $this->idCla = $idCla;
        $this->nomCla = $nomCla;
        $this->maxEtuCla = $maxEtuCla;
    }

    public function getIdCla(): int
    {
        return $this->idCla;
    }

    public function setIdCla(int $idCla): void
    {
        $this->idCla = $idCla;
    }

    public function getNomCla(): string
    {
        return $this->nomCla;
    }

    public function setNomCla(string $nomCla): void
    {
        $this->nomCla = $nomCla;
    }

    public function getMaxEtuCla(): int
    {
        return $this->maxEtuCla;
    }

    public function setMaxEtuCla(int $maxEtuCla): void
    {
        $this->maxEtuCla = $maxEtuCla;
    }

}