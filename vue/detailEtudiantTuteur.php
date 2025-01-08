<?php
include "headerTuteur.php";
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'tuteur') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

use DAO\EtudiantDAO;
require_once '../Modele\BDDManager.php';
require_once '../Modele\DAO\SpecialiteDAO.php';
require_once '../Modele\BO\Specialite.php';
require_once '../Modele\DAO\ClasseDAO.php';
require_once '../Modele\BO\Classe.php';
require_once '../Modele\DAO\EntrepriseDAO.php';
require_once '../Modele\BO\Entreprise.php';
require_once '../Modele\DAO\MaitreApprentissageDAO.php';
require_once '../Modele\BO\MaitreApprentissage.php';
require_once '../Modele\DAO\AdministrateurDAO.php';
require_once '../Modele\BO\Administrateur.php';
require_once '../Modele\BO\Utilisateur.php';
require_once '../Modele\BO\Bilan.php';
require_once '../Modele\BO\Bilan1.php';
require_once '../Modele\BO\Bilan2.php';
require_once '../Modele\DAO\Bilan1DAO.php';
require_once '../Modele\DAO\Bilan2DAO.php';
require_once '../Modele\BO\Tuteur.php';
require_once '../Modele\DAO\TuteurDAO.php';
require_once '../Modele\DAO\EtudiantDAO.php';
require_once '../Modele\BO\Etudiant.php';

$etudiantId = isset($_GET['id']) ? $_GET['id'] : null;

if ($etudiantId === null) {
    echo "Erreur : ID de l'étudiant manquant.";
    exit;
}

$bdd = initialiseConnexionBDD();
$etudiantDAO = new EtudiantDAO($bdd);
$etudiant = $etudiantDAO->getById($etudiantId);
$entreprise = $etudiant->getMonEntreprise();
$maitreapp = $etudiant->getMonTuteur();
if (!$etudiant) {
    echo "Erreur : Étudiant introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Informations Étudiant</title>
</head>
<body>

<div class="content">
    <div class="greyboxEt">
        <h1>Détail de l'étudiant <?php echo $etudiant->getNomUti() . ' ' . $etudiant->getPreUti(); ?></h1>
        <div class="whitebox">
            <div class="row">
                <div class="column">
                    <label>Nom  :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo $etudiant->getNomUti(); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Prénom :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo $etudiant->getPreUti(); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Téléphone :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo $etudiant->getTelUti(); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Adresse :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo $etudiant->getAdrUti(); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Email :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo $etudiant->getMailUti(); ?></span>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="column">
                    <label>Nom de l'entreprise :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($entreprise ? $entreprise->getNomEnt() : 'Aucune entreprise'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Adresse de l'entreprise :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($entreprise ? $entreprise->getAdrEnt() : 'Aucune entreprise'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Code postal de l'entreprise :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($entreprise ? $entreprise->getCpEnt() : 'Aucune entreprise'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Ville de l'entreprise :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($entreprise ? $entreprise->getVilEnt() : 'Aucune entreprise'); ?></span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="column">
                    <label>Nom du maître d'apprentissage de l'étudiant :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getNomUti() : "Aucune maître d'apprentissage"); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Prénom du maître d'apprentissage de l'étudiant:</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getPreUti() : "Aucune maître d'apprentissage"); ?></span>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label>Téléphone du maître d'apprentissage de l'étudiant :</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getTelUti() : "Aucune maître d'apprentissage"); ?></span>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label>Email du maître d'apprentissage de l'étudiant</label>
                </div>
                <div class="column-begin">
                    <span><?php echo htmlspecialchars($maitreapp ? $maitreapp->getMailUti() : "Aucune maître d'apprentissage"); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
