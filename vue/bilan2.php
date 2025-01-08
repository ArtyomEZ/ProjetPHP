<?php


use BO\Etudiant;

require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'etudiant') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

include './headerEtudiant.php';

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
require_once '../Modele\BO\Alerte.php';
require_once '../Modele\DAO\AlerteDAO.php';
$bdd = initialiseConnexionBDD();
$notedao = new DAO\Bilan1DAO($bdd);

$etudiantId = $_SESSION['user_id'];

$etudiantDAO = new DAO\EtudiantDAO($bdd);
$etudiant = $etudiantDAO->getById($etudiantId);
if ($etudiant) {

    $notedes = $etudiant->getMonBilan2();


} else {
    header('Location: pageConnexion.php');
    echo "Aucun étudiant trouvé avec l'ID spécifié.";
    exit;
}



?>

<link rel="stylesheet" href="../css/style4.css">
<body>

<main class="content">
    <h1>Bilan 1 - Premier Semestre 2024 - 2SIO</h1>
    <div class="greybox"><div class="whitebox">
            <div class="row">

                <div class="column column-begin"><strong>Note de Dossier:</strong></div>
                <div class="column column-end">
                    <strong> <?php echo htmlspecialchars($notedes ? $notedes->getNotDos() : 'Aucune note'); ?>
                </div>
            </div>
        </div>
        <div class="whitebox">
            <div class="row">
                <div class="column column-begin"><strong>Note de d'Oral:</strong></div>
                <div class="column column-end">
                    <strong>   <?php echo htmlspecialchars($notedes ? $notedes->getNotOral() : 'Aucune note' ); ?>
                </div>
            </div></div>
        <div class="whitebox">
            <div class="row">
                <div class="column column-begin"><strong>Moyenne du Bilan:</strong></div>
                <div class="column column-end"> <strong>   <?php
                        // Vérifier si les deux notes existent
                        if ($notedes !== null) {
                            $moyenne = ($notedes->getNotDos() + $notedes->getNotOral()) / 2;
                            echo number_format($moyenne, 2); // Affiche la moyenne avec 2 décimales
                        } else {
                            echo 'Notes manquantes';
                        }
                        ?><strong></div>
            </div></div>
        <div class="whitebox">
            <div class="row">
                <div class="column column-begin"><strong>Remarque:</strong></div>
                <div class="column column-end"> <strong> <?php echo htmlspecialchars($notedes ? $notedes->getRema() : 'Aucune Remarque' ); ?></strong></div>
            </div></div>
        <div class="whitebox">
            <div class="row">
                <div class="column column-begin"><strong>Sujet de Mémoire :</strong></div>
                <div class="column column-end">  <?php echo htmlspecialchars($notedes ? $notedes->getSujMem() : 'Aucun Sujet' ); ?><strong></div>
            </div></div>

    </div>
</main>
</body>
</html>