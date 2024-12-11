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

// Vérification des données POST
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

// Vérification des identifiants
    if ($etudiantDAO->ConnexionEtudiant($login, $password)) {
        header('Location: ../vue/pageAccueuilEtudiant.php'); // Page d'accueil étudiant
    } elseif ($tuteurDAO->ConnexionTuteur($login, $password)) {
        header('Location: ../vue/pageAccueilTuteur.php'); // Page d'accueil tuteur
    } elseif ($administrateurDAO->ConnexionAdministrateur($login, $password)) {
        header('Location: ../vue/pageAccueuilAdmin.php'); // Page d'accueil administrateur
    } else {
        // En cas d'échec, redirection vers la page de connexion avec un message d'erreur
        header('Location: ../vue/pageConnexion.php');
    }
    exit;
} else {
    // Si les champs ne sont pas remplis, redirection vers la page de connexion
    header('Location: ../vue/pageConnexion.php');
    exit;
}


