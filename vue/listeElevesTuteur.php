<?php

require_once 'init.php';
if (isset($_SESSION['login']) || $_SESSION['role'] !== 'tuteur') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

use DAO\TuteurDAO;
use DAO\EtudiantDAO;
use DAO\SpecialiteDAO;
use BO\Etudiant;
use BO\Specialite;

$bdd = initialiseConnexionBDD();
$tuteur = $_SESSION['user_id'];
$dao = new TuteurDAO($bdd);
$specialiteDAO = new SpecialiteDAO($bdd);
$etudiant = $dao->getEtuByTut($tuteur);
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
                            <a href="detailEtudiantTuteur.php?id=<?php echo $pnl->getidUti(); ?>">+info</a>
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