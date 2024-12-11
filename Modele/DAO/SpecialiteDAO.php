<?php

namespace DAO;

use BO\Specialite;
use PDO;

class SpecialiteDAO {
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function Create(Specialite $specialite): bool
    {
        try {

            $burger = "INSERT INTO Specialite (idSpe, nomSpe) VALUES (:idSpe, :nomSpe)";
            $stmt = $this->pdo->prepare($burger);

            $stmt->bindValue(':idSpe', $specialite->getIdSpe(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomSpe', $specialite->getNomSpe(), \PDO::PARAM_STR);

            return $stmt->execute();
        } catch (\Exception $e) {

            echo "Erreur dans la création d'une spécialité: " . $e->getMessage();
            return false;
        }
    }

    public function GetById(int $idSpe): ?Specialite
    {
        try {
            $burger = "SELECT * FROM Specialite WHERE idSpe = :idSpe";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idSpe', $idSpe, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                return new Specialite($result['idSpe'], $result['nomSpe']);
            }
            return null;
        } catch (Exception $e) {
            echo "Erreur pour la récup de la spé: " . $e->getMessage();
            return null;
        }
    }

    public function GetAll(): array
    {
        try {
            $burger = "SELECT * FROM Specialite";
            $stmt = $this->pdo->prepare($burger);
            $stmt->execute();  // Exécute la requête
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $specialites = [];
            foreach ($result as $row) {
                $specialites[] = new Specialite($row['idSpe'], $row['nomSpe']);
            }
            return $specialites;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des spécialités : " . $e->getMessage();
            return [];
        }
    }

    public function Update(Specialite $specialite): bool
    {
        try {
            $burger = "UPDATE Specialite SET nomSpe = :nomSpe WHERE idSpe = :idSpe";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idSpe', $specialite->getIdSpe(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomSpe', $specialite->getNomSpe(), \PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur dans la mise à jour: " . $e->getMessage();
            return false;
        }
    }

    public function Delete(int $idSpe): bool
    {
        try {
            $burger = "DELETE FROM Specialite WHERE idSpe = :idSpe";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idSpe', $idSpe, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur dans la suppression : " . $e->getMessage();
            return false;
        }
    }

}
