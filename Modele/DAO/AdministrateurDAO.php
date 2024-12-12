<?php

namespace DAO;

use BO\Administrateur;
use PDO;
use PDOException;

class AdministrateurDAO {

    private PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function Create(Administrateur $admin): bool {
        try {
            $burger = "INSERT INTO Utilisateur (nomUti, preUti, mailUti, telUti, adrUti, cpUti, vilUti, logUti, mdpUti, idTypUser) 
                      VALUES (:nomUti, :preUti, :mailUti, :telUti, :adrUti, :cpUti, :vilUti, :logUti, :mdpUti, :idTypUser)";
            $stmt = $this->pdo->prepare($burger);

            $stmt->bindValue('nomUti', $admin->getNomUti(), PDO::PARAM_STR);
            $stmt->bindValue('preUti', $admin->getPreUti(), PDO::PARAM_STR);
            $stmt->bindValue('mailUti', $admin->getMailUti(), PDO::PARAM_STR);
            $stmt->bindValue('telUti', $admin->getTelUti(), PDO::PARAM_STR);
            $stmt->bindValue('adrUti', $admin->getAdrUti(), PDO::PARAM_STR);
            $stmt->bindValue('cpUti', $admin->getCpUti(), PDO::PARAM_STR);
            $stmt->bindValue('vilUti', $admin->getVilUti(), PDO::PARAM_STR);
            $stmt->bindValue('logUti', $admin->getLogUti(), PDO::PARAM_STR);
            $stmt->bindValue('mdpUti', $admin->getMdpUti(), PDO::PARAM_STR);
            $stmt->bindValue('idTypUser',3, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la création de l'administrateur : " . $e->getMessage();
            return false;
        }
    }
    public function GetById(int $idUti): ?Administrateur {
        try {
            $burger = "SELECT * FROM Utilisateur WHERE idUti = :idUti";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idUti', $idUti, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return new Administrateur(
                    $result['idUti'],
                    $result['nomUti'],
                    $result['preUti'],
                    $result['mailUti'],
                    $result['telUti'],
                    $result['adrUti'],
                    $result['cpUti'],
                    $result['vilUti'],
                    $result['logUti'],
                    $result['mdpUti']
                );
            } else {
                return null;
            }
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération de l'administrateur : " . $e->getMessage();
            return null;
        }
    }
    public function getAll(): array {
        try {
            $query = "SELECT * FROM Utilisateur WHERE idTypUser = 3";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            $admins = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $admin = new Administrateur(
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
                $admins[] = $admin;
            }

            return $admins;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération des administrateurs : " . $e->getMessage();
            return [];
        }
    }

    public function Update(Administrateur $admin): bool {
        try {
            $burger = "UPDATE Utilisateur SET 
                  nomUti = :nomUti, preUti = :preUti, mailUti = :mailUti, telUti = :telUti, adrUti = :adrUti, 
                  cpUti = :cpUti, vilUti = :vilUti, logUti = :logUti, mdpUti = :mdpUti
                  WHERE idUti = :idUti";

            $stmt = $this->pdo->prepare($burger);

            $stmt->bindValue('nomUti', $admin->getNomUti(), PDO::PARAM_STR);
            $stmt->bindValue('preUti', $admin->getPreUti(), PDO::PARAM_STR);
            $stmt->bindValue('mailUti', $admin->getMailUti(), PDO::PARAM_STR);
            $stmt->bindValue('telUti', $admin->getTelUti(), PDO::PARAM_STR);
            $stmt->bindValue('adrUti', $admin->getAdrUti(), PDO::PARAM_STR);
            $stmt->bindValue('cpUti', $admin->getCpUti(), PDO::PARAM_STR);
            $stmt->bindValue('vilUti', $admin->getVilUti(), PDO::PARAM_STR);
            $stmt->bindValue('logUti', $admin->getLogUti(), PDO::PARAM_STR);
            $stmt->bindValue('mdpUti', $admin->getMdpUti(), PDO::PARAM_STR);
            $stmt->bindValue('idUti', $admin->getIdUti(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la mise à jour de l'administrateur : " . $e->getMessage();
            return false;
        }
    }

    public function Delete(int $idUti): bool {
        try {
            $burger = "DELETE FROM Utilisateur WHERE idUti = :idUti";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idUti', $idUti, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la suppression de l'administrateur : " . $e->getMessage();
            return false;
        }
    }

    public function ConnexionAdministrateur($login, $password) {
        $query = "SELECT * FROM Utilisateur WHERE logUti = :login AND mdpUti = :password AND idTypUser = 3";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère la première ligne comme un tableau associatif

        if ($result) {
            return $result['idUti']; // Retourne l'ID de l'étudiant
        } else {
            return false; // Si aucun utilisateur trouvé
        }

    }
}