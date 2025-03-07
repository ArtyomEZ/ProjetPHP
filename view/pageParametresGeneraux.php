<?php
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error='.($error));
    exit;
}


use DAO\ClasseDAO;
use DAO\TuteurDAO;
use DAO\EtudiantDAO;
use DAO\SpecialiteDAO;
use BO\Etudiant;
use BO\Specialite;

$bdd = initialiseConnexionBDD();
$dao = new TuteurDAO($bdd);
$specialiteDAO = new SpecialiteDAO($bdd);
$classeDAO = new ClasseDAO($bdd);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/pageAccueilAdm.css">
    <title>Paramètres Généraux</title>
</head>
<body>
    <?php
    include("../vue/headerAdmin.php");
    ?>
    <div class="content">
        <h1>Spécialités</h1>
        <div class="greybox">
            <?php $specialites = $specialiteDAO.getAll();
            foreach ($specialites as $specialite): ?>
            <div class="alertbox">
                <div class="alert-text-start">
                    <p><?php echo $specialite->getNom(); ?></p>
                </div>
                <div class="alert-text-end">
                    <a>-Supprimer</a>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <br>
        <h1>Classes</h1>
        <div class="greybox">
            <?php $classes = $classeDAO.getAll();
            foreach ($classes as $classe): ?>
                <div class="alertbox">
                    <div class="alert-text-start">
                        <p><?php echo $classe->getNom(); ?></p>
                    </div>
                    <div class="alert-text-end">
                        <a>-Supprimer</a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</body>
</html>
