<?php

namespace BO;

class Entreprise {

    private int $idEnt;
    private string $nomEnt;
    private string $adrEnt;
    private string $cpEnt;
    private string $vilEnt;

    public function __construct(int $idEnt, string $nomEnt, string $adrEnt, string $cpEnt, string $vilEnt)
    {
        $this->idEnt = $idEnt;
        $this->nomEnt = $nomEnt;
        $this->adrEnt = $adrEnt;
        $this->cpEnt = $cpEnt;
        $this->vilEnt = $vilEnt;
    }

    public function getIdEnt(): int
    {
        return $this->idEnt;
    }

    public function setIdEnt(int $idEnt): void
    {
        $this->idEnt = $idEnt;
    }

    public function getNomEnt(): string
    {
        return $this->nomEnt;
    }

    public function setNomEnt(string $nomEnt): void
    {
        $this->nomEnt = $nomEnt;
    }

    public function getAdrEnt(): string
    {
        return $this->adrEnt;
    }

    public function setAdrEnt(string $adrEnt): void
    {
        $this->adrEnt = $adrEnt;
    }

    public function getCpEnt(): string
    {
        return $this->cpEnt;
    }

    public function setCpEnt(string $cpEnt): void
    {
        $this->cpEnt = $cpEnt;
    }

    public function getVilEnt(): string
    {
        return $this->vilEnt;
    }

    public function setVilEnt(string $vilEnt): void
    {
        $this->vilEnt = $vilEnt;
    }


}