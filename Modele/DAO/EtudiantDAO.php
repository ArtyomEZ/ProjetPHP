<?php

namespace DAO;

use BO\Etudiant;
use PDO;

class EtudiantDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // CREATE
    public function create(Etudiant $etudiant): bool {
        try {
            $burger = "INSERT INTO Utilisateur 
            (nomUti, preUti, mailUti, telUti, adrUti, cpUti, vilUti, logUti, mdpUti, altUti, idTypUser, idSpe, idCla, idMai, idTut) 
            VALUES 
            (:nomUti, :preUti, :mailUti, :telUti, :adrUti, :cpUti, :vilUti, :logUti, :mdpUti, :altUti, :idTypUser, :idSpe, :idCla, :idMai, :idTut)";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':nomUti', $etudiant->getNomUti());
            $stmt->bindValue(':preUti', $etudiant->getPreUti());
            $stmt->bindValue(':mailUti', $etudiant->getMailUti());
            $stmt->bindValue(':telUti', $etudiant->getTelUti());
            $stmt->bindValue(':adrUti', $etudiant->getAdrUti());
            $stmt->bindValue(':cpUti', $etudiant->getCpUti());
            $stmt->bindValue(':vilUti', $etudiant->getVilUti());
            $stmt->bindValue(':logUti', $etudiant->getLogUti());
            $stmt->bindValue(':mdpUti', $etudiant->getMdpUti());
            $stmt->bindValue(':altUti', $etudiant->isAltEtu(), PDO::PARAM_BOOL);
            $stmt->bindValue(':idTypUser', 1, PDO::PARAM_INT);
            $stmt->bindValue(':idSpe', $etudiant->getIdSpecialite(), PDO::PARAM_INT);
            $stmt->bindValue(':idCla', $etudiant->getIdClasse(), PDO::PARAM_INT);
            $stmt->bindValue(':idMai', $etudiant->getIdMaiApp(), PDO::PARAM_INT);
            $stmt->bindValue(':idTut', $etudiant->getIdTuteur(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la création : " . $e->getMessage();
            return false;
        }
    }

    public function getById(int $idEtu): ?Etudiant {
        try {
            $burger = "SELECT * FROM Utilisateur WHERE idUti = :idUti AND idTypUser = 1";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idUti', $idEtu, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Etudiant(
                    $row['idUti'], $row['nomUti'], $row['preUti'], $row['mailUti'], $row['telUti'],
                    $row['adrUti'], $row['cpUti'], $row['vilUti'], $row['logUti'], $row['mdpUti'],
                    $row['altUti'], $row['idSpe'], $row['idCla'], $row['idMai'], $row['idTut'],
                    $row['$logUti'], $row['mdpUti'],
                );
            }
            return null;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return null;
        }
    }
    public function getAll(): array {
        try {
            $burger = "SELECT * FROM Utilisateur WHERE idTypUser = 1";
            $stmt = $this->pdo->prepare($burger);
            $stmt->execute();
            $lesEtu = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $etu = new Etudiant(
                    $row['altUti'],
                    $row['$monTuteur'],
                    $row['maClasse'],
                    $row['monMaiApp'],
                    $row['maSpecialite'],
                    $row['mesBilan1'],
                    $row['mesBilan2'],
                    $row['idUti'],
                    $row['nomUti'],
                    $row['preUti'],
                    $row['mailUti'],
                    $row['telUti'],
                    $row['adrUti'],
                    $row['cpUti'],
                    $row['vilUti'],
                    $row['logUti'],
                    $row['mdpUti'],
                );
                $lesEtu[] = $etu;
            }
            return $lesEtu;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération des étudiants : " . $e->getMessage();
            return [];
        }
    }
    public function update(Etudiant $etudiant): bool {
        try {
            $burger = "UPDATE Utilisateur SET 
            nomUti = :nomUti, preUti = :preUti, mailUti = :mailUti, telUti = :telUti, adrUti = :adrUti, 
            cpUti = :cpUti, vilUti = :vilUti, logUti = :logUti, mdpUti = :mdpUti, altUti = :altUti, 
            idSpe = :idSpe, idCla = :idCla, idMai = :idMai, idTut = :idTut
            WHERE idUti = :idUti";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':nomUti', $etudiant->getNomUti());
            $stmt->bindValue(':preUti', $etudiant->getPreUti());
            $stmt->bindValue(':mailUti', $etudiant->getMailUti());
            $stmt->bindValue(':telUti', $etudiant->getTelUti());
            $stmt->bindValue(':adrUti', $etudiant->getAdrUti());
            $stmt->bindValue(':cpUti', $etudiant->getCpUti());
            $stmt->bindValue(':vilUti', $etudiant->getVilUti());
            $stmt->bindValue(':logUti', $etudiant->getLogUti());
            $stmt->bindValue(':mdpUti', $etudiant->getMdpUti());
            $stmt->bindValue(':altUti', $etudiant->isAltEtu(), PDO::PARAM_BOOL);
            $stmt->bindValue(':idSpe', $etudiant->getIdSpecialite(), PDO::PARAM_INT);
            $stmt->bindValue(':idCla', $etudiant->getIdClasse(), PDO::PARAM_INT);
            $stmt->bindValue(':idMai', $etudiant->getIdMaiApp(), PDO::PARAM_INT);
            $stmt->bindValue(':idTut', $etudiant->getIdTuteur(), PDO::PARAM_INT);
            $stmt->bindValue(':idUti', $etudiant->getIdEtu(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }
}