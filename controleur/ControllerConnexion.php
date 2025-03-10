<?php
session_start();
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
$error = '';

// Vérification des données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($login) || empty($password)) {
        $error = 'Veuillez remplir tous les champs.';
        header('Location: ../vue/pageConnexion.php?error='.($error));
    } else {

        $etudiantId = $etudiantDAO->ConnexionEtudiant($login, $password);
        if ($etudiantId) {
            $_SESSION['user_id'] = $etudiantId;
            $_SESSION['role'] = 'etudiant';
            header('Location: ../vue/pageAccueilEtudiant.php');
            exit();
        }
        $tuteurId = $tuteurDAO->ConnexionTuteur($login, $password);
        if ($tuteurId) {
            $_SESSION['user_id'] = $tuteurId;
            $_SESSION['role'] = 'tuteur';
            header('Location: ../vue/pageAccueilTuteur.php');
            exit();
        }

        $adminId = $administrateurDAO->ConnexionAdministrateur($login, $password);
        if ($adminId) {
            $_SESSION['user_id'] = $adminId;
            $_SESSION['role'] = 'admin';

            header('Location: ../vue/pageAccueilAdmin.php');
            exit();
        }

        else {
            $error = 'Identifiants incorrects.';
            header('Location: ../vue/pageConnexion.php?error='.($error));
        }
    }
}