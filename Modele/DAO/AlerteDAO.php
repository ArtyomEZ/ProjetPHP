<?php

namespace DAO;

use BO\Etudiant;
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
                if ($etudiant->getMonBilan2()==null) {
                    if ($datLim2 < new \DateTime()) {
                        $tabEtudiant[] = $etudiant;
                    }
                }
            }
        }
        return $tabEtudiant;
    }

    public function getAlertesBilan1Admin(): ?array {
        $tabEtudiant = [];
        $etudiants = (new EtudiantDAO($this->pdo))->getAll();
        $sql = "SELECT * FROM Alerte WHERE datLim1 < NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $alerte = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($alerte) {
            $datLim1 = new \DateTime($alerte['datLim1']);
            foreach ($etudiants as $etudiant) {
                if ($etudiant->getMonBilan1() === null) {
                    if ($datLim1 < new \DateTime()) {
                        $tabEtudiant[] = $etudiant;
                    }
                }
            }
        }
        return $tabEtudiant;
    }

    public function getAlertesBilan2Admin(): ?array {
        $tabEtudiant = [];
        $etudiants = (new EtudiantDAO($this->pdo))->getAll();
        $sql = "SELECT * FROM Alerte WHERE datLim2 < NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $alerte = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($alerte) {
            $datLim2 = new \DateTime($alerte['datLim2']);
            foreach ($etudiants as $etudiant) {
                if ($etudiant->getMonBilan2() === null) {
                    if ($datLim2 < new \DateTime()) {
                        $tabEtudiant[] = $etudiant;
                    }
                }
            }
        }
        return $tabEtudiant;
    }







    public function getdatlim1(): string {
        $sql = "SELECT datLim1 FROM Alerte";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch()['datLim1'];
        return $res;
    }
    public function getdatlim2(): string {
        $sql = "SELECT datLim2 FROM Alerte";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch()['datLim2'];
        return $res;
    }

}