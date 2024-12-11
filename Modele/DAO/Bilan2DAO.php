<?php

namespace DAO;

use BO\Bilan2;
use PDO;

class Bilan2DAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // CREATE
    public function create(Bilan2 $bilan2): bool {
        try {
            $burger= "INSERT INTO Bilan2 (notDos2, notOral2, rema2, sujMem, datBil2, idUti)
                      VALUES (:notDos2, :notOral2, :rema2, :sujMem, :datBil2, :idUti)";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':notDos2', $bilan2->getNotDos(), PDO::PARAM_STR);
            $stmt->bindValue(':notOral2', $bilan2->getNotOral(), PDO::PARAM_STR);
            $stmt->bindValue(':rema2', $bilan2->getRema(), PDO::PARAM_STR);
            $stmt->bindValue(':sujMem', $bilan2->getSujMem(), PDO::PARAM_STR);
            $stmt->bindValue(':datBil2', $bilan2->getDatBil2(), PDO::PARAM_STR);
            $stmt->bindValue(':idUti', $bilan2->getMonEtu()->getIdUti(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la création du bilan2 : " . $e->getMessage();
            return false;
        }
    }
    public function getById(int $idBil2): ?Bilan2 {
        try {
            $burger = "SELECT * FROM Bilan2 WHERE idBil2 = :idBil2";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idBil2', $idBil2, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $etudiantDAO = new EtudiantDAO($this->pdo);
                $monEtu = $etudiantDAO->getById($row['idUti']);
                return new Bilan2(
                    $row['sujMem'],
                    $row['datBil2'],
                    $row['idBil2'],
                    $row['notDos2'],
                    $row['notOral2'],
                    $row['moyBil2'],
                    $row['rema2'],
                    $monEtu
                );
            }
            return null;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération du bilan2 : " . $e->getMessage();
            return null;
        }
    }
    public function update(Bilan2 $bilan2): bool {
        try {
            $burger = "UPDATE Bilan2 
                      SET notDos2 = :notDos2, 
                          notOral2 = :notOral2, 
                          moyBil2 = :moyBil2, 
                          rema2 = :rema2, 
                          sujMem = :sujMem, 
                          datBil2 = :datBil2, 
                          idUti = :idUti
                      WHERE idBil2 = :idBil2";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':notDos2', $bilan2->getNotDos(), PDO::PARAM_STR);
            $stmt->bindValue(':notOral2', $bilan2->getNotOral(), PDO::PARAM_STR);
            $stmt->bindValue(':moyBil2', $bilan2->getMoyBil(), PDO::PARAM_STR);
            $stmt->bindValue(':rema2', $bilan2->getRema(), PDO::PARAM_STR);
            $stmt->bindValue(':sujMem', $bilan2->getSujMem(), PDO::PARAM_STR);
            $stmt->bindValue(':datBil2', $bilan2->getDatBil2(), PDO::PARAM_STR);
            $stmt->bindValue(':idUti', $bilan2->getMonEtu()->getIdUti(), PDO::PARAM_INT);
            $stmt->bindValue(':idBil2', $bilan2->getIdBil(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la mise à jour du bilan2 : " . $e->getMessage();
            return false;
        }
    }
    public function delete(int $idBil2): bool {
        try {
            $burger = "DELETE FROM Bilan2 WHERE idBil2 = :idBil2";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idBil2', $idBil2, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la suppression du bilan2 : " . $e->getMessage();
            return false;
        }
    }
}