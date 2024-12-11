<?php

namespace DAO;

use BO\Tuteur;
use PDO;

class TuteurDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function create(Tuteur $tuteur): bool {
        $burger = "INSERT INTO Utilisateur (nomUti, preUti, mailUti, telUti, adrUti, cpUti, vilUti, logUti, mdpUti, nbrMaxEtu3, nbrMaxEtu4, nbrMaxEtu5, idTypUser)
                  VALUES (:nomUti, :preUti, :mailUti, :telUti, :adrUti, :cpUti, :vilUti, :logUti, :mdpUti, :nbrMaxEtu3, :nbrMaxEtu4, :nbrMaxEtu5, :idTypUser)";
        $stmt = $this->pdo->prepare($burger);
        $stmt->bindValue(':nomUti', $tuteur->getNomUti(), PDO::PARAM_STR);
        $stmt->bindValue(':preUti', $tuteur->getPreUti(), PDO::PARAM_STR);
        $stmt->bindValue(':mailUti', $tuteur->getMailUti(), PDO::PARAM_STR);
        $stmt->bindValue(':telUti', $tuteur->getTelUti(), PDO::PARAM_STR);
        $stmt->bindValue(':adrUti', $tuteur->getAdrUti(), PDO::PARAM_STR);
        $stmt->bindValue(':cpUti', $tuteur->getCpUti(), PDO::PARAM_STR);
        $stmt->bindValue(':vilUti', $tuteur->getVilUti(), PDO::PARAM_STR);
        $stmt->bindValue(':logUti', $tuteur->getLogUti(), PDO::PARAM_STR);
        $stmt->bindValue(':mdpUti', $tuteur->getMdpUti(), PDO::PARAM_STR);
        $stmt->bindValue(':nbrMaxEtu1', $tuteur->getNbrMaxEtu1(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu2', $tuteur->getNbrMaxEtu2(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu3', $tuteur->getNbrMaxEtu3(), PDO::PARAM_INT);
        $stmt->bindValue(':idTypUser', 2, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getById(int $idUti): ?Tuteur {
        $burger = "SELECT * FROM Utilisateur WHERE idUti = :idUti AND idTypUser = 2";
        $stmt = $this->pdo->prepare($burger);
        $stmt->bindValue(':idUti', $idUti, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Tuteur(
                $row['nbrMaxEtu3'],
                $row['nbrMaxEtu4'],
                $row['nbrMaxEtu5'],
                $row['idUti'],
                $row['nomUti'],
                $row['preUti'],
                $row['mailUti'],
                $row['telUti'],
                $row['adrUti'],
                $row['cpUti'],
                $row['vilUti'],
                $row['logUti'],
                $row['mdpUti']

            );
        }
        return null;
    }
    public function getAll(): array {
        try {
            $burger = "SELECT * FROM Utilisateur WHERE idTypUser = 2";
            $stmt = $this->pdo->prepare($burger);
            $stmt->execute();
            $lestuteurs = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tuteur = new Tuteur(
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
                    $row['nbrMaxEtu1'],
                    $row['nbrMaxEtu2'],
                    $row['nbrMaxEtu3'],

                );
                $lestuteurs[] = $tuteur;
            }
            return $lestuteurs;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération des tuteurs : " . $e->getMessage();
            return [];
        }
    }
    public function update(Tuteur $tuteur): bool {
        $burger = "UPDATE Utilisateur SET nomUti = :nomUti, preUti = :preUti, mailUti = :mailUti, telUti = :telUti, adrUti = :adrUti, cpUti = :cpUti, vilUti = :vilUti,
                  logUti = :logUti, mdpUti = :mdpUti, nbrMaxEtu3 = :nbrMaxEtu3, nbrMaxEtu4 = :nbrMaxEtu4, nbrMaxEtu5 = :nbrMaxEtu5 WHERE idUti = :idUti AND idTypUser = 2";
        $stmt = $this->pdo->prepare($burger);
        $stmt->bindValue(':idUti', $tuteur->getIdUti(), PDO::PARAM_INT);
        $stmt->bindValue(':nomUti', $tuteur->getNomUti(), PDO::PARAM_STR);
        $stmt->bindValue(':preUti', $tuteur->getPreUti(), PDO::PARAM_STR);
        $stmt->bindValue(':mailUti', $tuteur->getMailUti(), PDO::PARAM_STR);
        $stmt->bindValue(':telUti', $tuteur->getTelUti(), PDO::PARAM_STR);
        $stmt->bindValue(':adrUti', $tuteur->getAdrUti(), PDO::PARAM_STR);
        $stmt->bindValue(':cpUti', $tuteur->getCpUti(), PDO::PARAM_STR);
        $stmt->bindValue(':vilUti', $tuteur->getVilUti(), PDO::PARAM_STR);
        $stmt->bindValue(':logUti', $tuteur->getLogUti(), PDO::PARAM_STR);
        $stmt->bindValue(':mdpUti', $tuteur->getMdpUti(), PDO::PARAM_STR);
        $stmt->bindValue(':nbrMaxEtu1', $tuteur->getNbrMaxEtu1(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu2', $tuteur->getNbrMaxEtu2(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu3', $tuteur->getNbrMaxEtu3(), PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function delete(int $idUti): bool {
        $burger = "DELETE FROM Utilisateur WHERE idUti = :idUti AND idTypUser = 2";
        $stmt = $this->pdo->prepare($burger);
        $stmt->bindValue(':idUti', $idUti, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
