<?php

namespace DAO;

use BO\Bilan1;
use PDO;

class Bilan1DAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function create(Bilan1 $bilan1): bool
    {
        try {
            $burger = "INSERT INTO Bilan1 (notEnt1, notDos1, notOral1, rema1, datBil1, idUti)
                      VALUES (:notEnt1, :notDos1, :notOral1, :rema1, :datBil1, :idUti)";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':notEnt1', $bilan1->getNotEnt(), PDO::PARAM_STR);
            $stmt->bindValue(':notDos1', $bilan1->getNotDos(), PDO::PARAM_STR);
            $stmt->bindValue(':notOral1', $bilan1->getNotOral(), PDO::PARAM_STR);
            $stmt->bindValue(':rema1', $bilan1->getRema(), PDO::PARAM_STR);
            $stmt->bindValue(':datBil1', $bilan1->getDatVis1()->format('Y-m-d'), PDO::PARAM_STR);
            $stmt->bindValue(':idUti', $bilan1->getMonEtu()->getMonTuteur()->getIdUti(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la création du bilan : " . $e->getMessage();
            return false;
        }
    }
    public function getAll(): array {
        try {
            $burger = "SELECT * FROM Bilan1";
            $stmt = $this->pdo->prepare($burger);
            $stmt->execute();
            $lesBilans = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datVis1 = new \DateTime($row['datBil1']);
                $moyenne = round(($row['notEnt1'] + $row['notDos1'] + $row['notOral1']) / 3, 2);
                $etudiantDAO = new EtudiantDAO($this->pdo);
                $monEtu = null;
                if ($row['idUti']) {
                    $monEtu = $etudiantDAO->getById($row['idUti']);
                }

                $bilan = new Bilan1(
                    $datVis1,
                    $row['notEnt1'],
                    $row['idBil1'],
                    $row['notDos1'],
                    $row['notOral1'],
                    $row['rema1'],
                    $monEtu
                );

                $lesBilans[] = $bilan;
            }
            return $lesBilans;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération des bilans : " . $e->getMessage();
            return [];
        }
    }

    public function getById(int $idBil1): ?Bilan1
    {
        try {
            $burger = "SELECT * FROM Bilan1 WHERE idBil1 = :idBil1";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idBil1', $idBil1, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $d = new \DateTime($row['datBil1']);
                $etudiantDAO = new EtudiantDAO($this->pdo);
                $monEtu = null;
                if ($row['idUti']) {
                    $monEtu = $etudiantDAO->getById($row['idUti']);
                }
                return new Bilan1(
                    $d,
                    $row['notEnt1'],
                    $row['idBil1'],
                    $row['notDos1'],
                    $row['notOral1'],
                    $row['rema1'],
                    $monEtu
                );
            }
            return null;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération du bilan : " . $e->getMessage();
            return null;
        }
    }


    public function update(Bilan1 $bilan): bool {
        try {
            $burger = "UPDATE Bilan1 
                  SET notEnt1 = :notEnt1, 
                      notDos1 = :notDos1, 
                      notOral1 = :notOral1, 
                      rema1 = :rema1, 
                      datBil1 = :datBil1, 
                      idUti = :idUti
                  WHERE idBil1 = :idBil1";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':notEnt1', $bilan->getNotEnt(), PDO::PARAM_STR);
            $stmt->bindValue(':notDos1', $bilan->getNotDos(), PDO::PARAM_STR);
            $stmt->bindValue(':notOral1', $bilan->getNotOral(), PDO::PARAM_STR);
            $stmt->bindValue(':rema1', $bilan->getRema(), PDO::PARAM_STR);
            $stmt->bindValue(':datBil1', $bilan->getDatVis1()->format('Y-m-d'), PDO::PARAM_STR);
            $stmt->bindValue(':idUti', $bilan->getMonEtu()->getIdUti(), PDO::PARAM_INT);
            $stmt->bindValue(':idBil1', $bilan->getIdBil(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la mise à jour du bilan : " . $e->getMessage();
            return false;
        }
    }
    public function delete(int $idBil1): bool {
        try {
            $burger= "DELETE FROM Bilan1 WHERE idBil1 = :idBil1";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idBil1', $idBil1, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {

            echo "Erreur lors de la suppression du bilan : " . $e->getMessage();
            return false;
        }
    }


}