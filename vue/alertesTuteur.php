
<?php

use BO\Administrateur;
use BO\Alerte;
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
require_once '../Modele\BO\Alerte.php';
require_once '../Modele\DAO\AlerteDAO.php';
$bdd = initialiseConnexionBDD();
require_once 'init.php';
$AlerteDAO = new AlerteDAO($bdd);
$tuteurDAO = new TuteurDAO($bdd);
$idtuteur = $_SESSION['user_id'];
$pnl = $AlerteDAO->getAlertesBilan1Tuteur($lestuteurs = $tuteurDAO->getById($idtuteur));
?>
<div class="content">
    <h1>Alertes</h1>
    <div class="greybox">
        <?php
        if (!empty($pnl)) {
            foreach ($pnl as $etudiant) {
                $nom = $etudiant->getNomUti();
                $prenom = $etudiant->getPreUti();
                $monBilan1 = $etudiant->getMonBilan1();



                ?>
                <div class="alertbox">
                    <div class="alert-logo-space">
                        <img src="../img/logoAlerte.png" alt="logoAlerte" class="infoLogo">
                    </div>
                    <div class="alert-text-start">
                        <p><?php echo "Élève $nom $prenom - Retard sur le Bilan 1"; ?></p>
                    </div>
                    <div class="alert-text-end">
                        <p><?= '$dateLimite' ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Aucune alerte trouvée.</p>";
        }
        ?>
    </div>
</div>

