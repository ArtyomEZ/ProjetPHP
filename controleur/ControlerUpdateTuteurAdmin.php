<?php

require_once '../vue/init.php';
require_once '../Modele/BddManager.php';
require_once '../Modele/BO/Utilisateur.php';
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';

session_start();

// Récupération de l'ID du tuteur depuis GET
if (!isset($_POST['id']) || empty($_POST['id']) || !is_numeric($_POST['id'])) {
    $error = 'ID du tuteur manquant ou invalide.';
    header('Location: ../vue/pageGestionTuteur.php?error=' . urlencode($error));
    exit;
}

$tuteurId = (int) $_POST['id'];

$bdd = initialiseConnexionBDD();
$tuteurDAO = new DAO\TuteurDAO($bdd);

// Vérifier si le tuteur existe bien
$tuteur = $tuteurDAO->getById($tuteurId);
if (!$tuteur) {
    $error = 'Tuteur introuvable.';
    header('Location: ../vue/pageGestionTuteur.php?error=' . urlencode($error));
    exit;
}

// Vérification que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''));
    $telephone = htmlspecialchars(trim($_POST['telephone'] ?? ''));
    $mail = htmlspecialchars(trim($_POST['mail'] ?? ''));

    // Vérification des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($telephone) || empty($mail)) {
        $error = 'Veuillez remplir tous les champs.';
        header('Location: ../vue/pageGestionTuteur.php?error=' . urlencode($error));
        exit;
    }

    // Vérification du format de l'email


    // Mise à jour des informations
    $tuteur->setNomUti($nom);
    $tuteur->setPreUti($prenom);
    $tuteur->setTelUti($telephone);
    $tuteur->setMailUti($mail);

    $update = $tuteurDAO->update($tuteur);

    if ($update) {
        $modif = 'Changements effectués avec succès.';
        header('Location: ../vue/pageGestionTuteur.php?modif=' . urlencode($modif));
    } else {
        $error = "Erreur lors de la modification.";
        header('Location: ../vue/pageGestionTuteur.php?error=' . urlencode($error));
    }
}

?>
