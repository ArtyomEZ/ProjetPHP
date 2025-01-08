<?php

namespace DAO;

use BO\Bilan1;
use BO\Bilan2;
use BO\Etudiant;
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

        $stmt->bindValue(':nbrMaxEtu3', $tuteur->getNbrMaxEtu3(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu4', $tuteur->getNbrMaxEtu4(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu5', $tuteur->getNbrMaxEtu5(), PDO::PARAM_INT);
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
                    $row['mdpUti'],
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
        $stmt->bindValue(':nbrMaxEtu3', $tuteur->getNbrMaxEtu3(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu4', $tuteur->getNbrMaxEtu4(), PDO::PARAM_INT);
        $stmt->bindValue(':nbrMaxEtu5', $tuteur->getNbrMaxEtu5(), PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function delete(int $idUti): bool {
        $burger = "DELETE FROM Utilisateur WHERE idUti = :idUti AND idTypUser = 2";
        $stmt = $this->pdo->prepare($burger);
        $stmt->bindValue(':idUti', $idUti, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getEtuByTut(int $idTut): array {
        try {
            $query = "
            SELECT 
                U.*, 
                B1.idBil1, B1.notEnt1, B1.notDos1, B1.notOral1, B1.rema1, B1.datBil1, 
                B2.idBil2, B2.notDos2, B2.notOral2, B2.rema2, B2.sujMem, B2.datBil2
            FROM Utilisateur U
            LEFT JOIN Bilan1 B1 ON U.idUti = B1.idUti
            LEFT JOIN Bilan2 B2 ON U.idUti = B2.idUti
            WHERE U.idTut = :idTut AND U.idTypUser = 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idTut', $idTut, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $etudiants = [];
            foreach ($rows as $row) {
                $monTuteur = null;
                if (!is_null($row['idTut'])) {
                    $tuteurDAO = new TuteurDAO($this->pdo);
                    $monTuteur = $tuteurDAO->getById((int)$row['idTut']);
                }

                $maClasse = null;
                if (!is_null($row['idCla'])) {
                    $classeDAO = new ClasseDAO($this->pdo);
                    $maClasse = $classeDAO->getById((int)$row['idCla']);
                }

                $monMaiApp = null;
                if (!is_null($row['idMai'])) {
                    $maitreAppDAO = new MaitreApprentissageDAO($this->pdo);
                    $monMaiApp = $maitreAppDAO->getById((int)$row['idMai']);
                }

                $maSpecialite = null;
                if (!is_null($row['idSpe'])) {
                    $specialiteDAO = new SpecialiteDAO($this->pdo);
                    $maSpecialite = $specialiteDAO->getById((int)$row['idSpe']);
                }

                $monEntreprise = null;
                if ((bool)$row['altUti'] && !is_null($row['idEnt'])) {
                    $entrepriseDAO = new EntrepriseDAO($this->pdo);
                    $monEntreprise = $entrepriseDAO->getById((int)$row['idEnt']);
                }

                $monEtudiant = new Etudiant(
                    (bool)$row['altUti'],
                    $monEntreprise,
                    $monTuteur,
                    $maClasse,
                    $monMaiApp,
                    $maSpecialite,
                    null,
                    null,
                    (int)$row['idUti'],
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

                $monBilan1 = null;
                if (!is_null($row['idBil1'])) {
                    $monBilan1 = new Bilan1(
                        new \DateTime($row['datBil1']),
                        (float)$row['notEnt1'],
                        (int)$row['idBil1'],
                        (float)$row['notDos1'],
                        (float)$row['notOral1'],
                        $row['rema1'],
                        $monEtudiant
                    );
                }
                $monBilan2 = null;
                if (!is_null($row['idBil2'])) {
                    $monBilan2 = new Bilan2(
                        $row['sujMem'],
                        new \DateTime($row['datBil2']),
                        (int)$row['idBil2'],
                        (float)$row['notDos2'],
                        (float)$row['notOral2'],
                        $row['rema2'],
                        $monEtudiant
                    );
                }
                $monEtudiant->setMonBilan1($monBilan1);
                $monEtudiant->setMonBilan2($monBilan2);
                $etudiants[] = $monEtudiant;
            }

            return $etudiants;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération des étudiants : " . $e->getMessage();
            return [];
        }
    }
    public function ConnexionTuteur($login, $password) {
        $query = "SELECT * FROM Utilisateur WHERE logUti = :login AND mdpUti = :password AND idTypUser = 2";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['idUti'];
        } else {
            return false;
        }
    }



}
