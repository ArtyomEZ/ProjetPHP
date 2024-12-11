<?php

namespace DAO;

use BO\MaitreApprentissage;

class MaitreApprentissageDAO
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function Create(MaitreApprentissage $maitreApp): bool
    {
        try {

            $burger = "INSERT INTO Maitre_Apprentissage (idMai , nomMai,preMai,telMai,mailMai,idEnt   ) VALUES (:idMai , :nomMai,:preMai,:telMai,:mailMai,:idEnt)";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idMai', $maitreApp->getIdMai(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomMai', $maitreApp->getNomMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':preMai', $maitreApp->getPreMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':telMai', $maitreApp->getTelMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':mailMai', $maitreApp->getMailMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':idEnt', $maitreApp->getMonEnt()->getIdEnt(), \PDO::PARAM_STR);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur dans la création d'un maitre d'apprentissage: " . $e->getMessage();
            return false;
        }
    }

    public function GetById(int $idMai): ?MaitreApprentissage {
        try {
            $burger = "SELECT * FROM Maitre_Apprentissage WHERE idMai = :idMai";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idMai', $idMai, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                $ident =$result ['idEnt'];
                $daoEnt = new EntrepriseDAO($this->pdo);
                $ent = $daoEnt->GetById($ident);
                return new MaitreApprentissage($result['idMai'], $result['nomMai'], $result['preMai'], $result['telMai'], $result['mailMai'],$ent );
            }

            return null;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération du MaitreApprentissage: " . $e->getMessage();
            return null;
        }
    }

    public function GetAll(): array
    {
        try {
            $burger = "SELECT * FROM MaitreApprentissage";
            $stmt = $this->pdo->prepare($burger);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $MaitreApprentissage = [];
            foreach ($result as $row) {
                $ident = $result ['idEnt'];
                $daoEnt = new EntrepriseDAO($this->pdo);
                $ent = $daoEnt->GetById($ident);
                $MaitreApprentissage[] = new MaitreApprentissage($row['idMai'], $row['nomMai'], $row['preMai'], $row['telMai'], $row['mailMai'], $row[$ent]);
            }
            return $MaitreApprentissage;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des Maitre d'Apprentissages : " . $e->getMessage();
            return [];
        }
    }

        public function Update(MaitreApprentissage $MaitreApprentissage): bool {
        try {
            $burger = "UPDATE Maitre_Apprentissage SET 
                        idMai = :idMai,
                        nomMai = :nomMai, 
                        preMai = :preMai, 
                        telMai = :telMai,
                        mailMai = :mailMai,
                        idEnt = :idEnt
                      WHERE idMai = :idMai";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idMai', $MaitreApprentissage->getIdMai(), \PDO::PARAM_INT);
            $stmt->bindValue(':nomMai', $MaitreApprentissage->getNomMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':preMai', $MaitreApprentissage->getPreMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':telMai', $MaitreApprentissage->getTelMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':mailMai', $MaitreApprentissage->getMailMai(), \PDO::PARAM_STR);
            $stmt->bindValue(':idEnt', $MaitreApprentissage->getMonEnt()->getIdEnt(), \PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour du Maitre d'Apprentissage: " . $e->getMessage();
            return false;
        }
    }

    public function Delete(int $idMai): bool
    {
        try {
            $burger = "DELETE FROM Maitre_Apprentissage WHERE idMai = :idMai";
            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idMai', $idMai, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur lors de la suppression du Maitre d'Apprentissage: " . $e->getMessage();
            return false;
        }
    }

}