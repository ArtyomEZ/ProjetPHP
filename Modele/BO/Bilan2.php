<?php

namespace BO;
use DateTime;

require_once 'Bilan.php';
class Bilan2 extends Bilan {

    private string $sujMem;
    private datetime $datBil2;
    public function __construct(string $sujMem, DateTime $datBil2,int $idBil, float $notDos, float $notOral,string $rema,?Etudiant $monEtu)
    {
        $this->sujMem = $sujMem;
        $this->datBil2 = $datBil2;
        parent::__construct($idBil,$notDos,$notOral,$rema,$monEtu);
    }
    public function getSujMem(): string
    {
        return $this->sujMem;
    }

    public function setSujMem(string $sujMem): void
    {
        $this->sujMem = $sujMem;
    }

    public function getDatBil2(): DateTime
    {
        return $this->datBil2;
    }

    public function setDatBil2(DateTime $datBil2): void
    {
        $this->datBil2 = $datBil2;
    }




}