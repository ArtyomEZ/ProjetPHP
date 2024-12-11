<?php

namespace BO;

class Alerte {

    private int $idAlerte;

    private date $datLim1;

    private date $datLim2;


    public function __construct(int $idAlerte, date $datLim1, date $datLim2)
    {
        $this->idAlerte = $idAlerte;
        $this->datLim1 = $datLim1;
        $this->datLim2 = $datLim2;
    }

    public function getIdAlerte(): int
    {
        return $this->idAlerte;
    }

    public function setIdAlerte(int $idAlerte): void
    {
        $this->idAlerte = $idAlerte;
    }

    public function getDatLim1(): date
    {
        return $this->datLim1;
    }

    public function setDatLim1(date $datLim1): void
    {
        $this->datLim1 = $datLim1;
    }

    public function getDatLim2(): date
    {
        return $this->datLim2;
    }

    public function setDatLim2(date $datLim2): void
    {
        $this->datLim2 = $datLim2;
    }




}