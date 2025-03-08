<?php

namespace DAO;

use BO\Bilan1;
use BO\Bilan2;
use BO\Etudiant;
use PDO;

class EtudiantDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(Etudiant $etudiant): bool {
        try {
            $burger = "
        INSERT INTO Utilisateur 
        (nomUti, preUti, mailUti, telUti, adrUti, cpUti, vilUti, logUti, mdpUti, altUti, idTypUser, idSpe, idCla, idMai, idTut, idEnt) 
        VALUES 
        (:nomUti, :preUti, :mailUti, :telUti, :adrUti, :cpUti, :vilUti, :logUti, :mdpUti, :altUti, :idTypUser, :idSpe, :idCla, :idMai, :idTut, :idEnt)";

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
            if ($etudiant->isAltEtu()) {
                $stmt->bindValue(':idEnt', $etudiant->getMonEntreprise()->getIdEnt(), PDO::PARAM_INT);
            } else {
                $stmt->bindValue(':idEnt', null, PDO::PARAM_NULL);
            }
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la création : " . $e->getMessage();
            return false;
        }
    }


    public function getById(int $idEtu): ?Etudiant {
        try {
            $burger = "
        SELECT 
            U.*, 
            B1.idBil1, B1.notEnt1, B1.notDos1, B1.notOral1, B1.rema1, B1.datBil1, 
            B2.idBil2, B2.notDos2, B2.notOral2, B2.rema2, B2.sujMem, B2.datBil2
        FROM Utilisateur U
        LEFT JOIN Bilan1 B1 ON U.idUti = B1.idUti
        LEFT JOIN Bilan2 B2 ON U.idUti = B2.idUti
        WHERE U.idUti = :idUti AND U.idTypUser = 1";

            $stmt = $this->pdo->prepare($burger);
            $stmt->bindValue(':idUti', $idEtu, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
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

                return $monEtudiant;
            }

            return null;
        } catch (\Exception $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return null;
        }
    }




    public function getAll(): array {
        try {
            $burger = "
        SELECT 
            U.*, 
            B1.idBil1, B1.notEnt1, B1.notDos1, B1.notOral1, B1.rema1, B1.datBil1, 
            B2.idBil2, B2.notDos2, B2.notOral2, B2.rema2, B2.sujMem, B2.datBil2
        FROM Utilisateur U
        LEFT JOIN Bilan1 B1 ON U.idUti = B1.idUti
        LEFT JOIN Bilan2 B2 ON U.idUti = B2.idUti
        WHERE U.idTypUser = 1";
            $stmt = $this->pdo->prepare($burger);
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

    public function update(Etudiant $etudiant): bool {
        try {
            // La requête SQL pour mettre à jour les informations de l'étudiant
            $burger = "UPDATE Utilisateur SET
            nomUti = :nomUti, 
            preUti = :preUti, 
            mailUti = :mailUti, 
            telUti = :telUti, 
            adrUti = :adrUti,
            cpUti = :cpUti, 
            vilUti = :vilUti, 
            logUti = :logUti, 
            mdpUti = :mdpUti, 
            altUti = :altUti,
            idSpe = :idSpe, 
            idCla = :idCla, 
            idMai = :idMai, 
            idTut = :idTut,
            idEnt = :idEnt
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

            // si etu en alt, on maj l'id de l'entreprise, sinon on lmet a null
            if ($etudiant->isAltEtu()) {
                $stmt->bindValue(':idEnt', $etudiant->getMonEntreprise()->getIdEnt(), PDO::PARAM_INT);
            } else {
                $stmt->bindValue(':idEnt', null, PDO::PARAM_NULL);
            }
            $stmt->bindValue(':idUti', $etudiant->getIdEtu(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    public function delete(int $idEtu): bool {
        try {
            $sql = "DELETE FROM Utilisateur WHERE idUti = :idUti AND idTypUser = 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':idUti', $idEtu, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return false;
        }
    }

    public function ConnexionEtudiant($login, $password) {
        $query = "SELECT idUti FROM Utilisateur WHERE logUti = :login AND mdpUti = :password AND idTypUser = 1";
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

    public function assignerTuteur(int $idEtu, int $idTuteur): bool {
        try {
            $sql = "UPDATE Utilisateur SET idTut = :idTut WHERE idUti = :idUti AND idTypUser = 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':idTut', $idTuteur, PDO::PARAM_INT);
            $stmt->bindValue(':idUti', $idEtu, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de l'assignation du tuteur : " . $e->getMessage();
            return false;
        }
    }
    public function desassignerTuteur(int $idEtu): bool {
        try {
            $sql = "UPDATE Utilisateur SET idTut = NULL WHERE idUti = :idUti AND idTypUser = 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':idUti', $idEtu, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\Exception $e) {
            echo "Erreur lors de la désassignation du tuteur : " . $e->getMessage();
            return false;
        }
    }
}