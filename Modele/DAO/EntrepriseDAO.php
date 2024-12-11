<?php

namespace DAO;

use BO\Entreprise;
use PDO;

class EntrepriseDAO {

    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function Create(Entreprise $entreprise): bool
    {
        try {
            $burger= "INSERT INTO Entreprise (idEnt, nomEnt, adrEnt, cpEnt, vilEnt) 
                      VALUES (:idEnt, :nomEnt, :adrEnt, :cpEnt, :vilEnt)";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idEnt', $entreprise->getIdEnt(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomEnt', $entreprise->getNomEnt(), \PDO::PARAM_STR);
            $stmt->bindValue(':adrEnt', $entreprise->getAdrEnt(), \PDO::PARAM_STR);
            $stmt->bindValue(':cpEnt', $entreprise->getCpEnt(), \PDO::PARAM_STR);
            $stmt->bindValue(':vilEnt', $entreprise->getVilEnt(), \PDO::PARAM_STR);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur dans la création de l'entreprise: " . $e->getMessage();
            return false;
        }
    }

    public function GetById(int $idEnt): ?Entreprise
    {
        try {
            $burger = "SELECT * FROM Entreprise WHERE idEnt = :idEnt";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idEnt', $idEnt, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                return new Entreprise($result['idEnt'], $result['nomEnt'], $result['adrEnt'], $result['cpEnt'], $result['vilEnt']);
            }
            return null;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de l'entreprise: " . $e->getMessage();
            return null;
        }
    }

    public function GetAll(): array
    {
        try {
            $burger = "SELECT * FROM Entreprise";
            $stmt = $this->pdo->prepare($burger);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $entreprises = [];
            foreach ($result as $row) {
                $entreprises[] = new Entreprise($row['idEnt'], $row['nomEnt'], $row['adrEnt'], $row['cpEnt'], $row['vilEnt']);
            }
            return $entreprises;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des entreprises : " . $e->getMessage();
            return [];
        }
    }

    public function Update(Entreprise $entreprise): bool
    {
        try {
            $burger = "UPDATE Entreprise SET 
                        nomEnt = :nomEnt, 
                        adrEnt = :adrEnt, 
                        cpEnt = :cpEnt, 
                        vilEnt = :vilEnt 
                      WHERE idEnt = :idEnt";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idEnt', $entreprise->getIdEnt(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomEnt', $entreprise->getNomEnt(), \PDO::PARAM_STR);
            $stmt->bindValue(':adrEnt', $entreprise->getAdrEnt(), \PDO::PARAM_STR);
            $stmt->bindValue(':cpEnt', $entreprise->getCpEnt(), \PDO::PARAM_STR);
            $stmt->bindValue(':vilEnt', $entreprise->getVilEnt(), \PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour de l'entreprise: " . $e->getMessage();
            return false;
        }
    }
    public function Delete(int $idEnt): bool
    {
        try {
            $verif = "SELECT COUNT(*) FROM maitreapprentissage WHERE idEnt = :idEnt";
            $checkStmt = $this->pdo->prepare($verif);
            $checkStmt->bindValue(':idEnt', $idEnt, \PDO::PARAM_INT);
            $checkStmt->execute();
            $nbrMaiApp = $checkStmt->fetchColumn();
            if ($nbrMaiApp > 0) {
                echo "Impossible de supprimer cette entreprise car elle est liée à un maître d'apprentissage.";
                return false;
            }
            $burger = "DELETE FROM entreprise WHERE idEnt = :idEnt";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idEnt', $idEnt, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'entreprise: " . $e->getMessage();
            return false;
        }
    }

}