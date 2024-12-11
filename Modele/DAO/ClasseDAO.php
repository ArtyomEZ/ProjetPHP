<?php

namespace DAO;

use BO\Classe;
use PDO;

class ClasseDAO {
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function Create(Classe $classe): bool
    {
        try {
            $burger= "INSERT INTO Classe (idCla, nomCla, maxEtuCla) VALUES (:idCla, :nomCla, :maxEtuCla)";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idCla', $classe->getIdCla(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomCla', $classe->getNomCla(), \PDO::PARAM_STR);
            $stmt->bindValue(':maxEtuCla', $classe->getMaxEtuCla(), \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur dans la création de la classe: " . $e->getMessage();
            return false;
        }
    }

    public function GetById(int $idCla): ?Classe
    {
        try {
            $burger = "SELECT * FROM Classe WHERE idCla = :idCla";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idCla', $idCla, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                return new Classe($result['idCla'], $result['nomCla'], $result['maxEtuCla']);
            }
            return null;
        } catch (\Exception $e) {
            echo "Erreur pour récupérer la classe: " . $e->getMessage();
            return null;
        }
    }

    public function GetAll(): array {
        try {
            $burger = "SELECT * FROM Classe";
            $stmt = $this->pdo->prepare($burger);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $classes = [];
            foreach ($result as $row) {
                $classes[] = new Classe($row['idCla'], $row['nomCla'], $row['maxEtuCla']);
            }
            return $classes;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération des classes: " . $e->getMessage();
            return [];
        }
    }

    public function Update(Classe $classe): bool
    {
        try {
            $burger = "UPDATE Classe SET nomCla = :nomCla, maxEtuCla = :maxEtuCla WHERE idCla = :idCla";
            $stmt = $this->pdo->prepare($burger);

            $stmt->bindValue(':idCla', $classe->getIdCla(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomCla', $classe->getNomCla(), \PDO::PARAM_STR);
            $stmt->bindValue(':maxEtuCla', $classe->getMaxEtuCla(), \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur dans la mise à jour de la classe: " . $e->getMessage();
            return false;
        }
    }

    public function Delete(int $idCla): bool
    {
        try {
            $burger = "DELETE FROM Classe WHERE idCla = :idCla";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idCla', $idCla, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur dans la suppression de la classe: " . $e->getMessage();
            return false;
        }
    }
}