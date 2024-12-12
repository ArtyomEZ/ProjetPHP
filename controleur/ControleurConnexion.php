<?php
use BO\Administrateur;
use BO\Bilan;
use BO\Bilan1;
use BO\Bilan2;
use BO\Classe;
use BO\Entreprise;
use BO\Etudiant;
use BO\MaitreApprentissage;
use BO\Specialite;
use BO\Tuteur;
use BO\Utilisateur;
use DAO\AdministrateurDAO;
use DAO\AlerteDAO;
use DAO\Bilan1DAO;
use DAO\Bilan2DAO;
use DAO\ClasseDAO;
use DAO\EntrepriseDAO;
use DAO\EtudiantDAO;
use DAO\MaitreApprentissageDAO;
use DAO\SpecialiteDAO;
use DAO\TuteurDAO;

require_once '../Modele/BDDManager.php';
require_once '../Modele/DAO/AdministrateurDAO.php';
require_once '../Modele/BO/Administrateur.php';
require_once '../Modele/BO/Utilisateur.php';
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';
require_once '../Modele/DAO/EtudiantDAO.php';
require_once '../Modele/BO/Etudiant.php';
require_once '../Modele/BO/Alerte.php';
require_once '../Modele/DAO/AlerteDAO.php';


$bdd = initialiseConnexionBDD();

$etudiantDAO = new EtudiantDAO($bdd);
$tuteurDAO = new TuteurDAO($bdd);
$administrateurDAO = new AdministrateurDAO($bdd);

session_start(); // Démarre la session pour stocker les données utilisateur

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Vérification des identifiants pour l'étudiant
    $etudiantId = $etudiantDAO->ConnexionEtudiant($login, $password);
    if ($etudiantId) {
        $_SESSION['user_id'] = $etudiantId; // Stocke l'ID utilisateur en session
        $_SESSION['role'] = 'etudiant'; // Stocke le rôle de l'utilisateur
        header('Location: ../vue/pageAccueuilEtudiant.php'); // Redirection vers la page d'accueil de l'étudiant
        exit();
    }$tuteurId = $tuteurDAO->ConnexionTuteur($login, $password);
    if ($tuteurId) {
        $_SESSION['user_id'] = $tuteurId; // Stocke l'ID utilisateur en session
        $_SESSION['role'] = 'tuteur'; // Stocke le rôle du tuteur
        header('Location: ../vue/pageAccueilTuteur.php'); // Redirection vers la page d'accueil du tuteur
        exit();
    }

    // Vérification pour l'administrateur
    $adminId = $administrateurDAO->ConnexionAdministrateur($login, $password);
    if ($adminId) {
        $_SESSION['user_id'] = $adminId; // Stocke l'ID utilisateur en session
        $_SESSION['role'] = 'admin'; // Stocke le rôle de l'administrateur
        header('Location: ../vue/pageAccueilAdmin.php'); // Redirection vers la page d'accueil de l'administrateur
        exit();
    }

    // En cas d'échec de connexion
    header('Location: ../vue/pageConnexion.php'); // Redirection vers la page de connexion
    exit();
}