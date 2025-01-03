<?php
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

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
$etudiantdao = new EtudiantDAO($bdd);
$specialiteDAO = new SpecialiteDAO($bdd);

$etudiant = $etudiantdao->getAll();





?>


<div class="content">
    <h1>Liste d'Etudiants</h1>
    <div class="greybox">
        <div class="whitebox">
            <table>
                <tr>
                    <th>
                        Nom
                    </th>
                    <th>
                        Prénom
                    </th>
                    <th>
                        Téléphone
                    </th>
                    <th>
                        Mail
                    </th>
                    <th>
                        Spécialité
                    </th>
                    <th>
                        Classe
                    </th>
                    <th>
                        Tuteur
                    </th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($etudiant as $pnl) : ?>
                    <tr>
                        <td>
                            <?php echo $pnl->getNomUti(); ?>
                        </td>
                        <td>
                            <?php echo $pnl->getPreUti(); ?>
                        </td>
                        <td>
                            <?php echo $pnl->getTelUti(); ?>
                        </td>
                        <td>
                            <?php echo $pnl->getMailUti(); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($pnl->getMaSpecialite() ? $pnl->getMaSpecialite()->getNomSpe() : 'Aucune'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($pnl->getMaClasse() ? $pnl->getMaClasse()->getNomCla() : 'Aucune'); ?>
                        </td>
                        <td>
                            <?php echo $pnl->getMonTuteur()->getNomUti(); ?>
                        </td>
                        <td>
                            <a href="">+info</a>
                        </td>
                        <td>
                            <a href="">+modifier</a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </table>
        </div>
    </div>
</div>