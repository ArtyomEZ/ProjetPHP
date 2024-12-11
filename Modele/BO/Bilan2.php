<?php

namespace BO;

use Cassandra\Date;
require_once 'Bilan.php';
class Bilan2 extends Bilan {

    private string $sujMem;
    private date $datBil2;

    public function __construct(string $sujMem, date $datBil2, int $idBil, float $notDos, float $notOral,float $moyBil,string $rema,Etudiant $monEtu)
    {
        $this->sujMem = $sujMem;
        $this->datBil2 = $datBil2;
        parent::__construct($idBil,$notDos,$notOral,$moyBil,$rema,$monEtu);
    }

    public function getSujMem(): string
    {
        return $this->sujMem;
    }

    public function setSujMem(string $sujMem): void
    {
        $this->sujMem = $sujMem;
    }

    public function getDatBil2(): date
    {
        return $this->datBil2;
    }

    public function setDatBil2(date $datBil2): void
    {
        $this->datBil2 = $datBil2;
    }


}