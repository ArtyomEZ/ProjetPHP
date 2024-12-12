<?php

namespace BO;

use Couchbase\User;

class Tuteur extends Utilisateur {

    private int $nbrMaxEtu3;
    private int $nbrMaxEtu4;
    private int $nbrMaxEtu5;

    public function __construct(int $nbrMaxEtu3, int $nbrMaxEtu4, int $nbrMaxEtu5,int $idUti, string $nomUti, string $preUti, string $mailUti, string $telUti, string $adrUti, string $cpUti,string $vilUti,string $logUti, string $mdpUti )
    {
        $this->nbrMaxEtu3 = $nbrMaxEtu3;
        $this->nbrMaxEtu4 = $nbrMaxEtu4;
        $this->nbrMaxEtu5 = $nbrMaxEtu5;
        parent::__construct($idUti, $nomUti,  $preUti,  $mailUti,  $telUti,  $adrUti,  $cpUti,  $vilUti,  $logUti,  $mdpUti);
    }

    public function getNbrMaxEtu3(): int
    {
        return $this->nbrMaxEtu3;
    }

    public function setNbrMaxEtu3(int $nbrMaxEtu3): void
    {
        $this->nbrMaxEtu3 = $nbrMaxEtu3;
    }

    public function getNbrMaxEtu4(): int
    {
        return $this->nbrMaxEtu4;
    }

    public function setNbrMaxEtu4(int $nbrMaxEtu4): void
    {
        $this->nbrMaxEtu4 = $nbrMaxEtu4;
    }

    public function getNbrMaxEtu5(): int
    {
        return $this->nbrMaxEtu5;
    }

    public function setNbrMaxEtu5(int $nbrMaxEtu5): void
    {
        $this->nbrMaxEtu5 = $nbrMaxEtu5;
    }






}