<?php

use DAO\TuteurDAO;

require_once '../vue/init.php';
if (isset($_SESSION['login']) || $_SESSION['role'] !== 'etudiant') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}


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



$etudiantId = $_SESSION['user_id'];
$bdd = initialiseConnexionBDD();
$etudiantDAO = new DAO\EtudiantDAO($bdd);
$tuteurDAO = new TuteurDAO($bdd);
$etudiant = $etudiantDAO->getById($etudiantId);
if (!$etudiant) {
    $error = 'Étudiant introuvable avec l\' Id' . htmlspecialchars($etudiantId);
    header('Location: ../vue/MesinfoEtudiant.php?error=' . urlencode($error));
    exit;
}

$nom = htmlspecialchars($_POST['nomEtudiant']);
$prenom = htmlspecialchars($_POST['prenomEtudiant']);
$telephone = htmlspecialchars($_POST['telEtudiant']);
$adresse = htmlspecialchars($_POST['adresseEtudiant']);
$mail = htmlspecialchars($_POST['mailEtudiant']);

if (empty($nom) || empty($prenom) || empty($telephone) || empty($adresse) || empty($mail)) {
    $error = 'Veuillez remplir tous les champs.';
    header('Location: ../vue/MesinfoEtudiant.php?error=' . urlencode($error));
    exit;
}

$etudiant->setNomUti($nom);
$etudiant->setPreUti($prenom);
$etudiant->setTelUti($telephone);
$etudiant->setAdrUti($adresse);
$etudiant->setMailUti($mail);


$update = $etudiantDAO->update($etudiant);

if ($update) {
    $modif = 'Changements effectués';
    header('Location: ../vue/MesinfoEtudiant.php?modif=' . urlencode($modif));
} else {
    $error = "Erreur lors de la modification.";
    header('Location: ../vue/MesinfoEtudiant.php?error=' . urlencode($error));
}

