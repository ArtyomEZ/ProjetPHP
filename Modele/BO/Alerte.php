<?php

namespace BO;

class Alerte {

    private int $idAlerte;

    private \DateTime $datLim1;

    private \DateTime $datLim2;


    public function __construct(int $idAlerte, \DateTime $datLim1, \DateTime $datLim2)
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

    public function getDatLim1(): \DateTime
    {
        return $this->datLim1;
    }

    public function setDatLim1(\DateTime $datLim1): void
    {
        $this->datLim1 = $datLim1;
    }

    public function getDatLim2(): \DateTime
    {
        return $this->datLim2;
    }

    public function setDatLim2(\DateTime $datLim2): void
    {
        $this->datLim2 = $datLim2;
    }

}