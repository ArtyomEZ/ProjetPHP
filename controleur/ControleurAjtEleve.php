<?php

use BO\Bilan1;
use BO\Classe;
use BO\Entreprise;
use BO\Etudiant;
use BO\MaitreApprentissage;
use BO\Specialite;
use BO\Tuteur;

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

$bdd = initialiseConnexionBDD();
$etudiantDAO = new DAO\EtudiantDAO($bdd);

if (
    isset($_POST['nomEtudiant']) && !empty($_POST['nomEtudiant']) &&
    isset($_POST['prenomEtudiant']) && !empty($_POST['prenomEtudiant']) &&
    isset($_POST['telephoneEtudiant']) && !empty($_POST['telephoneEtudiant']) &&
    isset($_POST['adresseEtudiant']) && !empty($_POST['adresseEtudiant']) &&
    isset($_POST['mailEtudiant']) && !empty($_POST['mailEtudiant'])
) {
    // ✅ Récupération des données de l'étudiant
    $nom = htmlspecialchars($_POST['nomEtudiant']);
    $prenom = htmlspecialchars($_POST['prenomEtudiant']);
    $telephone = htmlspecialchars($_POST['telephoneEtudiant']);
    $adresse = htmlspecialchars($_POST['adresseEtudiant']);
    $mail = htmlspecialchars($_POST['mailEtudiant']);

    // ✅ Récupération des données de l'entreprise
    $nomE = htmlspecialchars($_POST['nomEntreprise'] ?? '');
    $adrE = htmlspecialchars($_POST['adresseEntreprise'] ?? '');
    $cpE = htmlspecialchars($_POST['codePostalEntreprise'] ?? '');
    $ville = htmlspecialchars($_POST['villeEntreprise'] ?? '');

    $entreprise = new Entreprise(0, $nomE, $adrE, $cpE, $ville);
    $entrepriseDAO = new DAO\EntrepriseDAO($bdd);

    if ($entrepriseDAO->Create($entreprise)) {
        $idEntreprise = $bdd->lastInsertId();
        $entreprise = new Entreprise($idEntreprise, $nomE, $adrE, $cpE, $ville); // ✅ Mise à jour avec l'ID

        // ✅ Récupération des données du maître d'apprentissage
        $nomM = htmlspecialchars($_POST['nomMaitreApprentissage'] ?? '');
        $preM = htmlspecialchars($_POST['prenomMaitreApprentissage'] ?? '');
        $telM = htmlspecialchars($_POST['telephoneMaitreApprentissage'] ?? '');
        $mailM = htmlspecialchars($_POST['mailMaitreApprentissage'] ?? '');

        $maitre = new MaitreApprentissage(0, $nomM, $preM, $telM, $mailM, $entreprise);
        $maitredao = new \DAO\MaitreApprentissageDAO($bdd);

        if ($maitredao->Create($maitre)) {
            $idMaitre = $bdd->lastInsertId();
            $maitre = new MaitreApprentissage($idMaitre, $nomM, $preM, $telM, $mailM, $entreprise);

            // ✅ Champs par défaut
            $codePostal = 'null';
            $villes = 'null';
            $login = 'null';
            $mdp = 'null';
            $specialite = new Specialite(1, 'null');
            $date = new DateTime('2024-12-02');
            $tuteur = new Tuteur(0, 0, 0, 1, 'null', 'null', 'null', 'null', 'null', 'null', 'null0', 'null', 'null');
            $classe = new Classe(1, 'null', 0);
            $bilan1 = new Bilan1($date, 0, 0, 0, 0, 'rien', null);
            $bilan2 = new \BO\Bilan2('null', $date, 0, 0, 0, 'rien', null);


            // ✅ Création de l'étudiant
            $etudiant = new Etudiant(
                false,
                $entreprise,
                $tuteur,
                $classe,
                $maitre,
                $specialite,
                $bilan1,
                $bilan2,
                0,
                $nom,
                $prenom,
                $mail,
                $telephone,
                $adresse,
                $codePostal,
                $villes,
                $login,
                $mdp
            );


            if ($etudiantDAO->create($etudiant)) {
                header('Location: ../vue/pageAccueilAdmin.php');

            } else {
                header('Location: ../vue/parametreAdmin.php');
                echo "❌ L'élève {$prenom} {$nom} n'a pas pu être ajouté.";
            }

        } else {
            header('Location: ../vue/parametreAdmin.php');
            echo "❌ Erreur dans la création du maître d'apprentissage.";
        }

    } else {
        header('Location: ../vue/parametreAdmin.php');
        echo "❌ Erreur dans la création de l'entreprise.";
    }

} else {
    header('Location: ../vue/parametreAdmin.php');
    echo "❌ Veuillez remplir tous les champs obligatoires de l'étudiant.";
}
