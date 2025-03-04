<?php

require_once '../vue/init.php';
require_once '../Modele/BddManager.php';
require_once '../Modele/BO/Utilisateur.php';
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';

session_start();

// Vérification des permissions
if (!isset($_SESSION['login']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'tuteur')) {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . urlencode($error));
    exit;
}

// Vérification que l'ID est bien passé dans le formulaire
if (!isset($_POST['idTuteur']) || empty($_POST['idTuteur'])) {
    $error = 'ID du tuteur manquant.';
    header('Location: ../vue/mesinfosTuteur.php?error=' . urlencode($error));
    exit;
}

$tuteurId = (int) $_POST['idTuteur'];
$nom = trim(htmlspecialchars($_POST['nom']));
$prenom = trim(htmlspecialchars($_POST['prenom']));
$telephone = trim(htmlspecialchars($_POST['telephone']));
$mail = trim(htmlspecialchars($_POST['mail']));

// Vérification des champs obligatoires
if (empty($nom) || empty($prenom) || empty($telephone) || empty($mail)) {
    $error = 'Veuillez remplir tous les champs.';
    header('Location: ../vue/mesinfosTuteur.php?error=' . urlencode($error));
    exit;
}

// Vérification du format de l'email
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $error = 'Adresse e-mail invalide.';
    header('Location: ../vue/mesinfosTuteur.php?error=' . urlencode($error));
    exit;
}

$bdd = initialiseConnexionBDD();
$tuteurDAO = new DAO\TuteurDAO($bdd);

// Vérifier si le tuteur existe bien
$tuteur = $tuteurDAO->getById($tuteurId);
if (!$tuteur) {
    $error = 'Tuteur introuvable.';
    header('Location: ../vue/mesinfosTuteur.php?error=' . urlencode($error));
    exit;
}

// Mise à jour des informations
$tuteur->setNomUti($nom);
$tuteur->setPreUti($prenom);
$tuteur->setTelUti($telephone);
$tuteur->setMailUti($mail);

$update = $tuteurDAO->update($tuteur);

if ($update) {
    $modif = 'Changements effectués avec succès.';
    header('Location: ../vue/mesinfosTuteur.php?modif=' . urlencode($modif));
} else {
    $error = 'Erreur lors de la modification.';
    header('Location: ../vue/mesinfosTuteur.php?error=' . urlencode($error));
}
?>