<?php

namespace BO;

use Cassandra\Date;
require_once 'Bilan.php';
class Bilan1 extends Bilan {

private date $datVis1;
private float $notEnt;

    public function __construct(date $datVis1, float $notEnt, int $idBil, float $notDos,float $notOral,float $moyBil, string $rema, Etudiant $monEtu ) {
        $this->datVis1 = $datVis1;
        $this->notEnt = $notEnt;
    parent::__construct($idBil,$notDos,$notOral,$moyBil,$rema,$monEtu);
    }

    public function getDatVis1(): Date
    {
        return $this->datVis1;
    }

    public function setDatVis1(Date $datVis1): void
    {
        $this->datVis1 = $datVis1;
    }

    public function getNotEnt(): float
    {
        return $this->notEnt;
    }

    public function setNotEnt(float $notEnt): void
    {
        $this->notEnt = $notEnt;
    }

}