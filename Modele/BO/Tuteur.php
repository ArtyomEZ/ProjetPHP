<?php

namespace BO;

use Couchbase\User;

class Tuteur extends Utilisateur {

    private int $nbrMaxEtu1;
    private int $nbrMaxEtu2;
    private int $nbrMaxEtu3;

    public function __construct(int $nbrMaxEtu1, int $nbrMaxEtu2, int $nbrMaxEtu3,int $idUti, string $nomUti, string $preUti, string $mailUti, string $telUti, string $adrUti, string $cpUti,string $vilUti,string $logUti, string $mdpUti )
    {
        $this->nbrMaxEtu1 = $nbrMaxEtu1;
        $this->nbrMaxEtu2 = $nbrMaxEtu2;
        $this->nbrMaxEtu3 = $nbrMaxEtu3;
        parent::__construct($idUti, $nomUti,  $preUti,  $mailUti,  $telUti,  $adrUti,  $cpUti,  $vilUti,  $logUti,  $mdpUti);
    }

    public function getNbrMaxEtu1(): int
    {
        return $this->nbrMaxEtu1;
    }

    public function setNbrMaxEtu1(int $nbrMaxEtu1): void
    {
        $this->nbrMaxEtu1 = $nbrMaxEtu1;
    }

    public function getNbrMaxEtu2(): int
    {
        return $this->nbrMaxEtu2;
    }

    public function setNbrMaxEtu2(int $nbrMaxEtu2): void
    {
        $this->nbrMaxEtu2 = $nbrMaxEtu2;
    }

    public function getNbrMaxEtu3(): int
    {
        return $this->nbrMaxEtu3;
    }

    public function setNbrMaxEtu3(int $nbrMaxEtu3): void
    {
        $this->nbrMaxEtu3 = $nbrMaxEtu3;
    }



}