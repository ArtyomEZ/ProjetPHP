<?php

require_once 'init.php';
if (isset($_SESSION['login']) || $_SESSION['role'] !== 'etudiant') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}


include 'headerEtudiant.php';


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
$bdd = initialiseConnexionBDD();
$etudiantDAO = new DAO\EtudiantDAO($bdd);


$etudiantId = $_SESSION['user_id'];




$etudiant = $etudiantDAO->getById($etudiantId);
if ($etudiant) {

    $entreprise = $etudiant->getMonEntreprise();


    $maitre = $etudiant->getMonMaiApp();

} else {
    header('Location: pageConnexion.php');
    echo "Aucun étudiant trouvé avec l'ID spécifié.";
    exit;
}



?>


    <HTML>
<head>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>


<div class="content">

    <div class="greyboxEt">
        <h1>Mes informations étudiants</h1>
        <div class="whitebox">
            <form action="pageAccueilEtudiant.php" method="post">
                <input type="hidden" name="idEtudiant" value="<?php echo htmlspecialchars($etudiant->getIdUti()); ?>">
                <div class="row">
                    <div class="column">
                        <label>Nom :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($etudiant->getNomUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Prénom :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($etudiant->getPreUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Téléphone :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($etudiant->getTelUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Adresse :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($etudiant->getAdrUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Mail :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($etudiant->getMailUti()); ?>">
                    </div>
                </div>

                <hr>
                <h1>Entreprise (optionel)</h1>
                <div class="row">
                    <div class="column">
                        <label>Nom :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($entreprise ? $entreprise->getNomEnt() : 'Aucune entreprise'); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Adresse :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($entreprise ? $entreprise->getAdrEnt() : ''); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Code Postal :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($entreprise ? $entreprise->getCpEnt() : ''); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Ville :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($entreprise ? $entreprise->getVilEnt() : ''); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Nom maître apprentissage :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($maitre ? $maitre->getNomMai() : 'Aucun maître d\'apprentissage'); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label>Prénom maître apprentissage :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($maitre ? $maitre->getPreMai() : ''); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Tel maître apprentissage :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($maitre ? $maitre->getTelMai() : ''); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Mail maître apprentissage :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" value="<?php echo htmlspecialchars($maitre ? $maitre->getMailMai() : ''); ?>">
                    </div>
                </div>

                <br>


                <div class="row">
                    <div class ="button">
                        <input type="submit" value="Confirmer" >
                    </div>

                </div>


            </form>



            <br>
            <br>
            <br>
        </div>
    </div>
</div>
</body>
    </HTML><?php
