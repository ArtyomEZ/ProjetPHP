<?php
require_once 'init.php';
require_once '../Modele/BDDManager.php';
require_once '../Modele/DAO/SpecialiteDAO.php';
require_once '../Modele/BO/Specialite.php';
require_once '../Modele/DAO/ClasseDAO.php';
require_once '../Modele/BO/Classe.php';
;
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';
require_once '../Modele/DAO/EtudiantDAO.php';
require_once '../Modele/BO/Etudiant.php';

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
    <link rel="stylesheet" href="../css/pageAcceuilAdmin.css">
    <title>Paramètres Généraux</title>
</head>
<body>
    <?php
    include("../vue/headerAdmin.php");
    ?>
    <div class="content">
        <h1>Spécialités</h1>
        <div class="greybox">
            <?php $specialites = $specialiteDAO->GetAll();
            foreach ($specialites as $specialite): ?>
            <div class="alertbox">
                <div class="alert-text-start">
                    <p><?php echo $specialite->getNomSpe(); ?></p>
                </div>
                <div class="alert-text-end">
                    <a href="../controleur/ControlerDeleteSpecialite.php?id=<?php echo $specialite->getIdSpecialite(); ?>" style="color: blue;">+Supprimer</a>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <br>
        <h1>Classes</h1>
        <div class="greybox">
            <?php $classes = $classeDAO->GetAll();
            foreach ($classes as $classe): ?>
                <div class="alertbox">
                    <div class="alert-text-start">
                        <p><?php echo $classe->getNomCla(); ?></p>
                    </div>
                    <div class="alert-text-end">
                        <a href="../controleur/ControlerDeleteClasse.php?id=<?php echo $classe->getIdClasse(); ?>" style="color: blue;">+Supprimer</a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</body>
</html>
