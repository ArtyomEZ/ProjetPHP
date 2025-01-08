<?php

namespace BO;

class Utilisateur {

    protected int $idUti;
    protected string $nomUti;
    protected string $preUti;
    protected string $mailUti;
    protected string $telUti;
    protected string $adrUti;
    protected string $cpUti;
    protected string $vilUti;
    protected string $logUti;
    protected string $mdpUti;


    public function __construct(int $idUti, string $nomUti, string $preUti, string $mailUti, string $telUti, string $adrUti, string $cpUti, string $vilUti, string $logUti, string $mdpUti)
    {
        $this->idUti = $idUti;
        $this->nomUti = $nomUti;
        $this->preUti = $preUti;
        $this->mailUti = $mailUti;
        $this->telUti = $telUti;
        $this->adrUti = $adrUti;
        $this->cpUti = $cpUti;
        $this->vilUti = $vilUti;
        $this->logUti = $logUti;
        $this->mdpUti = $mdpUti;

    }

    public function getIdUti(): int
    {
        return $this->idUti;
    }

    public function setIdUti(int $idUti): void
    {
        $this->idUti = $idUti;
    }

    public function getNomUti(): string
    {
        return $this->nomUti;
    }

    public function setNomUti(string $nomUti): void
    {
        $this->nomUti = $nomUti;
    }

    public function getPreUti(): string
    {
        return $this->preUti;
    }

    public function setPreUti(string $preUti): void
    {
        $this->preUti = $preUti;
    }

    public function getMailUti(): string
    {
        return $this->mailUti;
    }

    public function setMailUti(string $mailUti): void
    {
        $this->mailUti = $mailUti;
    }

    public function getTelUti(): string
    {
        return $this->telUti;
    }

    public function setTelUti(string $telUti): void
    {
        $this->telUti = $telUti;
    }

    public function getAdrUti(): string
    {
        return $this->adrUti;
    }

    public function setAdrUti(string $adrUti): void
    {
        $this->adrUti = $adrUti;
    }

    public function getCpUti(): string
    {
        return $this->cpUti;
    }

    public function setCpUti(string $cpUti): void
    {
        $this->cpUti = $cpUti;
    }

    public function getVilUti(): string
    {
        return $this->vilUti;
    }

    public function setVilUti(string $vilUti): void
    {
        $this->vilUti = $vilUti;
    }

    public function getLogUti(): string
    {
        return $this->logUti;
    }

    public function setLogUti(string $logUti): void
    {
        $this->logUti = $logUti;
    }

    public function getMdpUti(): string
    {
        return $this->mdpUti;
    }

    public function setMdpUti(string $mdpUti): void
    {
        $this->mdpUti = $mdpUti;
    }





}