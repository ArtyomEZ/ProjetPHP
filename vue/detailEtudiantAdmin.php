<?php
include "headerAdmin.php";
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

use DAO\EtudiantDAO;
use DAO\Bilan1DAO;
use DAO\Bilan2DAO;

require_once '../Modele/BDDManager.php';
require_once '../Modele/DAO/SpecialiteDAO.php';
require_once '../Modele/BO/Specialite.php';
require_once '../Modele/DAO/ClasseDAO.php';
require_once '../Modele/BO/Classe.php';
require_once '../Modele/DAO/EntrepriseDAO.php';
require_once '../Modele/BO/Entreprise.php';
require_once '../Modele/DAO/MaitreApprentissageDAO.php';
require_once '../Modele/BO/MaitreApprentissage.php';
require_once '../Modele/DAO/AdministrateurDAO.php';
require_once '../Modele/BO/Administrateur.php';
require_once '../Modele/BO/Utilisateur.php';
require_once '../Modele/BO/Bilan.php';
require_once '../Modele/BO/Bilan1.php';
require_once '../Modele/BO/Bilan2.php';
require_once '../Modele/DAO/Bilan1DAO.php';
require_once '../Modele/DAO/Bilan2DAO.php';
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';
require_once '../Modele/DAO/EtudiantDAO.php';
require_once '../Modele/BO/Etudiant.php';

$etudiantId = isset($_GET['id']) ? $_GET['id'] : null;

if ($etudiantId === null) {
    echo "Erreur : ID de l'étudiant manquant.";
    exit;
}

$bdd = initialiseConnexionBDD();
$etudiantDAO = new EtudiantDAO($bdd);
$etudiant = $etudiantDAO->getById($etudiantId);

if (!$etudiant) {
    echo "Erreur : Étudiant introuvable.";
    exit;
}

$entreprise = $etudiant->getMonEntreprise();
$maitreapp = $etudiant->getMonTuteur();

// Récupération du Bilan1
$bilan1DAO = new Bilan1DAO($bdd);
$bilan1 = $bilan1DAO->getById($etudiantId);

// Récupération du Bilan2
$bilan2DAO = new Bilan2DAO($bdd);
$bilan2 = $bilan2DAO->getById($etudiantId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style4.css">
    <title>Informations Étudiant</title>
</head>
<body>

<div class="content">
    <div class="greyboxEt">
        <h1>Détail de l'étudiant <?php echo htmlspecialchars($etudiant->getNomUti() . ' ' . $etudiant->getPreUti()); ?></h1>
        <div class="whitebox">
            <!-- Informations de l'étudiant -->
            <div class="row">
                <div class="column"><label>Nom :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($etudiant->getNomUti()); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Prénom :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($etudiant->getPreUti()); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Téléphone :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($etudiant->getTelUti()); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Adresse :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($etudiant->getAdrUti()); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Email :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($etudiant->getMailUti()); ?></span></div>
            </div>

            <hr>

            <!-- Informations sur l'entreprise -->
            <h2>Entreprise</h2>
            <div class="row">
                <div class="column"><label>Nom de l'entreprise :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($entreprise ? $entreprise->getNomEnt() : 'Aucune entreprise'); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Adresse de l'entreprise :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($entreprise ? $entreprise->getAdrEnt() : 'Aucune entreprise'); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Code postal :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($entreprise ? $entreprise->getCpEnt() : 'Aucune entreprise'); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Ville :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($entreprise ? $entreprise->getVilEnt() : 'Aucune entreprise'); ?></span></div>
            </div>

            <hr>

            <!-- Maître d'apprentissage -->
            <h2>Maître d'Apprentissage</h2>
            <div class="row">
                <div class="column"><label>Nom :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getNomUti() : "Aucun maître d'apprentissage"); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Prénom :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getPreUti() : "Aucun maître d'apprentissage"); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Téléphone :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getTelUti() : "Aucun maître d'apprentissage"); ?></span></div>
            </div>
            <div class="row">
                <div class="column"><label>Email :</label></div>
                <div class="column-begin"><span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getMailUti() : "Aucun maître d'apprentissage"); ?></span></div>
            </div>

            <hr>

            <!-- Bilan 1 -->
            <h2>Bilan 1 - Premier Semestre</h2>
            <?php if ($bilan1): ?>
                <div class="row">
                    <div class="column"><strong>Note de l'Entreprise :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan1->getNotEnt()); ?></div>
                </div>
                <div class="row">
                    <div class="column"><strong>Note de Dossier :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan1->getNotDos()); ?></div>
                </div>
                <div class="row">
                    <div class="column"><strong>Note de l'Oral :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan1->getNotOral()); ?></div>
                </div>
                <div class="row">
                    <div class="column"><strong>Moyenne du Bilan :</strong></div>
                    <div class="column-begin">
                  <?php

                    if ($bilan1 !== null) {
                        $moyenne = ($bilan1->getNotDos() + $bilan1->getNotOral() +$bilan1->getNotEnt())/ 3;
                        echo number_format($moyenne, 2);
                    } else {
                        echo 'Données manquantes';
                    }
                    ?>
                    </div>
                </div>
                <div class="row">
                    <div class="column"><strong>Remarque :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan1->getRema()); ?></div>
                </div>
            <?php else: ?>
                <p>Aucun Bilan 1 trouvé pour cet étudiant.</p>
            <?php endif; ?>

            <hr>

            <!-- Bilan 2 -->
            <h2>Bilan 2 - Second Semestre</h2>
            <?php if ($bilan2): ?>
                <div class="row">
                    <div class="column"><strong>Note de Dossier :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan2->getNotDos()); ?></div>
                </div>
                <div class="row">
                    <div class="column"><strong>Note d'Oral :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan2->getNotOral()); ?></div>
                </div>
                <div class="row">
                    <div class="column"><strong>Moyenne du Bilan :</strong></div>
                    <div class="column-begin">
                        <?php

                        if ($bilan1 !== null) {
                            $moyenne = ($bilan2->getNotDos() + $bilan2->getNotOral())/ 2;
                            echo number_format($moyenne, 2);
                        } else {
                            echo 'Données manquantes';
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="column"><strong>Remarque :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan2->getRema()); ?></div>
                </div>
                <div class="row">
                    <div class="column"><strong>Sujet de Mémoire :</strong></div>
                    <div class="column-begin"><?php echo htmlspecialchars($bilan2->getSujMem()); ?></div>
                </div>
            <?php else: ?>
                <p>Aucun Bilan 2 trouvé pour cet étudiant.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
