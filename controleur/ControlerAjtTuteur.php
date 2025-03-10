<?php

use BO\Tuteur;
use DAO\ClasseDAO;
use DAO\TuteurDAO;


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

// Initialisation de la connexion à la base de données
$bdd = initialiseConnexionBDD();
$classeDAO = new ClasseDAO($bdd);
$tuteurDAO = new TuteurDAO($bdd);
// Vérification des données du formulaire
if (
    isset($_POST['nomTuteur']) && !empty($_POST['nomTuteur']) &&
    isset($_POST['prenomTuteur']) && !empty($_POST['prenomTuteur']) &&
    isset($_POST['telephoneTuteur']) && !empty($_POST['telephoneTuteur']) &&
    isset($_POST['mailTuteur']) && !empty($_POST['mailTuteur'])
) {
    $nom = htmlspecialchars($_POST['nomTuteur']);
    $prenom = htmlspecialchars($_POST['prenomTuteur']);
    $telephone = htmlspecialchars($_POST['telephoneTuteur']);
    $mail = htmlspecialchars($_POST['mailTuteur']);


    // Récupérer la classe depuis la BDD




        $nbrMaxEtu3 = 5;
        $nbrMaxEtu4 = 5;
        $nbrMaxEtu5 = 5;
        $idUti = 0;
        $adrUti = 'Adresse par défaut';
        $cpUti = '00000';
        $vilUti = 'Ville par défaut';
        $logUti = 'loginTuteur';
        $mdpUti = 'mdpTuteur';

        // Création de l'objet Tuteur
        $tuteur = new Tuteur(
            $nbrMaxEtu3,
            $nbrMaxEtu4,
            $nbrMaxEtu5,
            $idUti,
            $nom,
            $prenom,
            $mail,
            $telephone,
            $adrUti,
            $cpUti,
            $vilUti,
            $logUti,
            $mdpUti
        );


//         Enregistrer le tuteur dans la base de données
        if ($tuteurDAO->create($tuteur)) {
            $modif1 = '✅ Tueur ajouté en base de données';
            header('Location: ../vue/parametreAdmin.php?modif1='. urlencode($modif1));
        } else {
            $modif1 = "❌ Erreur lors de l'ajout du tuteur.";
            header('Location: ../vue/parametreAdmin.php?modif1='. urlencode($modif1));


    }
} else {
    $modif1 = "❌ Veuillez remplir tous les champs obligatoires du formulaire.";
    header('Location: ../vue/parametreAdmin.php?modif1=' . urlencode($modif1));

}
