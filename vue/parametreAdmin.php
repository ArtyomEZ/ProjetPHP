<?php
include 'headerAdmin.php';



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
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Étudiant et Tuteur</title>
    <link rel="stylesheet" href="../css/style3.css"> <!-- Assure-toi que ce fichier CSS est bien lié -->
</head>
<body class="connexion">

<!-- Conteneur Principal -->
<div class="form-container">

    <!-- Section Étudiant + Entreprise -->
    <div class="form-section">
        <h2>Nouvel Étudiant</h2>
        <form action="../controleur/ControleurAjtEleve.php" method="post">
            <!-- Informations Étudiant -->
            <div class="row">
                <div class="column">Nom :</div>
                <div class="column-begin"><input type="text" name="nomEtudiant"></div>
            </div>
            <div class="row">
                <div class="column">Prénom :</div>
                <div class="column-begin"><input type="text" name="prenomEtudiant"></div>
            </div>
            <div class="row">
                <div class="column">Téléphone :</div>
                <div class="column-begin"><input type="text" name="telephoneEtudiant"></div>
            </div>
            <div class="row">
                <div class="column">Adresse :</div>
                <div class="column-begin"><input type="text" name="adresseEtudiant"></div>
            </div>
            <div class="row">
                <div class="column">Mail :</div>
                <div class="column-begin"><input type="text" name="mailEtudiant"></div>
            </div>

            <!-- Section Entreprise -->
            <div class="enterprise-section">
                <h2>Entreprise (optionnel)</h2>
                <div class="row">
                    <div class="column">Nom :</div>
                    <div class="column-begin"><input type="text" name="nomEntreprise"></div>
                </div>
                <div class="row">
                    <div class="column">Adresse :</div>
                    <div class="column-begin"><input type="text" name="adresseEntreprise"></div>
                </div>
                <div class="row">
                    <div class="column">Code Postal :</div>
                    <div class="column-begin"><input type="text" name="codePostalEntreprise"></div>
                </div>
                <div class="row">
                    <div class="column">Ville :</div>
                    <div class="column-begin"><input type="text" name="villeEntreprise"></div>
                </div>
                <div class="row">
                    <div class="column">Nom Maître d'Apprentissage :</div>
                    <div class="column-begin"><input type="text" name="nomMaitreApprentissage"></div>
                </div>
                <div class="row">
                    <div class="column">Prénom Maître d'Apprentissage :</div>
                    <div class="column-begin"><input type="text" name="prenomMaitreApprentissage"></div>
                </div>
                <div class="row">
                    <div class="column">Téléphone Maître d'Apprentissage :</div>
                    <div class="column-begin"><input type="text" name="telephoneMaitreApprentissage"></div>
                </div>
                <div class="row">
                    <div class="column">Mail Maître d'Apprentissage :</div>
                    <div class="column-begin"><input type="text" name="mailMaitreApprentissage"></div>
                </div>
            </div>

            <!-- Bouton de confirmation pour Étudiant + Entreprise -->
            <div class="button">
                <input type="submit" value="Confirmer">
            </div>
        </form>
    </div>

    <div class="form-section tuteur">
        <h2>Nouveau Tuteur</h2>
        <form action="../controleur/ControlerAjtTuteur.php" method="post">
            <div class="row">
                <div class="column">Nom :</div>
                <div class="column-begin"><input type="text" name="nomTuteur"></div>
            </div>
            <div class="row">
                <div class="column">Prénom :</div>
                <div class="column-begin"><input type="text" name="prenomTuteur"></div>
            </div>
            <div class="row">
                <div class="column">Téléphone :</div>
                <div class="column-begin"><input type="text" name="telephoneTuteur"></div>
            </div>
            <div class="row">
                <div class="column">Mail :</div>
                <div class="column-begin"><input type="text" name="mailTuteur"></div>
            </div>
            <div class="row">
                <div class="column">Classe :</div>
                <div class="column-begin">
                    <select name="classeTuteur">
                        <option value="">Sélectionner une classe</option>
                        <?php
                        // Récupérer toutes les classes depuis la base de données
                        $bdd = initialiseConnexionBDD();
                        $classeDAO = new \DAO\ClasseDAO($bdd);
                        $classes = $classeDAO->getAll();
                        foreach ($classes as $classe) {
                            echo "<option value='{$classe->getIdCla()}'>{$classe->getNomCla()}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Bouton de confirmation pour Tuteur -->
            <div class="button">
                <input type="submit" value="Confirmer">
            </div>
        </form>
    </div>
</body>
</html>