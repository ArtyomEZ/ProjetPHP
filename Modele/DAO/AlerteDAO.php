<?php

namespace DAO;

use BO\Tuteur;
use PDO;

class AlerteDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAlertesBilan1Tuteur(Tuteur $tuteur) : ?array {
        $tabEtudiant = [];
        $etudiants = (new TuteurDAO($this->pdo))->getEtuByTut($tuteur->getIdUti());
        $sql = "SELECT * FROM Alerte WHERE datLim1 < NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $alerte = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($alerte) {
            $datLim1 = new \DateTime($alerte['datLim1']);
            foreach ($etudiants as $etudiant) {
                if ($etudiant->getmonBilan1()==null) {
                    if ($datLim1 < new \DateTime()) {
                        $tabEtudiant[] = $etudiant;
                    }
                }
            }
        }
        return $tabEtudiant;
    }

    public function getAlertesBilan2Tuteur(Tuteur $tuteur) : ?array {
        $tabEtudiant = [];
        $etudiants = (new TuteurDAO($this->pdo))->getEtuByTut($tuteur->getIdUti());
        $sql = "SELECT * FROM Alerte WHERE datLim2 < NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $alerte = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($alerte) {
            $datLim2 = new \DateTime($alerte['datLim2']);
            foreach ($etudiants as $etudiant) {
                if ($etudiant->getmonBilan2()==null) {
                    if ($datLim2 < new \DateTime()) {
                        $tabEtudiant[] = $etudiant;
                    }
                }
            }
        }
        return $tabEtudiant;
    }





}