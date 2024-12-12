<?php

namespace BO;

use DateTime;

require_once 'Bilan.php';
class Bilan1 extends Bilan {

private datetime $datVis1;
private float $notEnt;

    public function __construct(dateTime $datVis1, float $notEnt, int $idBil, float $notDos,float $notOral, string $rema, ?Etudiant $monEtu ) {
        $this->datVis1 = $datVis1;
        $this->notEnt = $notEnt;
    parent::__construct($idBil,$notDos,$notOral,$rema,$monEtu);
    }

    public function getDatVis1(): DateTime
    {
        return $this->datVis1;
    }

    public function setDatVis1(DateTime $datVis1): void
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