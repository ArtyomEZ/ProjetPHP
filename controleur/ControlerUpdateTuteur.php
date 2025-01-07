<?php

require_once '../vue/init.php';
if (isset($_SESSION['login']) || $_SESSION['role'] !== 'tuteur') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

require_once '../Modele\BDDManager.php';
require_once '../Modele\BO\Utilisateur.php';
require_once '../Modele\BO\Tuteur.php';
require_once '../Modele\DAO\TuteurDAO.php';

$tuteurId = $_SESSION['user_id'];
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$telephone = htmlspecialchars($_POST['telephone']);
$mail = htmlspecialchars($_POST['mail']);

if (empty($nom) || empty($prenom)|| empty($telephone)|| empty($mail)) {
    $error = 'Veuillez remplir tous les champs.';
    header('Location: ../vue/MesinfoTuteur.php?error='.urlencode($error));
    exit;
}

$bdd = initialiseConnexionBDD();
$tuteurDAO = new DAO\TuteurDAO($bdd);

$tuteur = $tuteurDAO->getById($tuteurId);
if (!$tuteur) {
    $error = 'Tuteur introuvable';
    header('Location: ../vue/MesinfoTuteur.php?error=' . urlencode($error));
    exit;
}
$tuteur->setNomUti($nom);
$tuteur->setPreUti($prenom);
$tuteur->setTelUti($telephone);
$tuteur->setMailUti($mail);

$update = $tuteurDAO->update($tuteur);

if ($update) {
    $modif='Changements effectués';
    header('Location: ../vue/MesinfoTuteur.php?modif='. urlencode($modif));
} else {
    $error = "Erreur lors de la modification.";
    header('Location: ../vue/MesinfoTuteur.php?error=' . urlencode($error));
}