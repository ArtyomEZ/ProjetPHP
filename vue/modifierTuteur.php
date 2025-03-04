<?php


require_once '../vue/init.php';
require_once '../Modele/BddManager.php';
require_once '../Modele/BO/Utilisateur.php';
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';

include "headerAdmin.php";
require_once 'init.php';



$bdd = initialiseConnexionBDD();
$tuteurDAO = new DAO\TuteurDAO($bdd);

// Déterminer l'ID du tuteur
if ($_SESSION['role'] === 'admin' && isset($_GET['id'])) {
    $tuteurId = (int) $_GET['id'];
} else {
    $tuteurId = $_SESSION['user_id'];
}

$tuteur = $tuteurDAO->getById($tuteurId);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Tuteur</title>
    <link type="text/css" rel="stylesheet" href="../css/style4.css">
</head>
<body>
<div class="content">
    <h1>Modifier un Tuteur</h1>
    <div class="greybox">
        <div class="whitebox">
            <form action="../controleur/ControlerUpdateTuteurAdmin.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($tuteur->getIdUti()); ?>">
                <div class="msg-erreur">
                    <?php if (isset($_GET['error'])): ?>
                        <p style="color: red;"> <?= htmlspecialchars($_GET['error']); ?> </p>
                    <?php endif; ?>
                    <?php if (isset($_GET['modif'])): ?>
                        <p style="color: green;"> <?= htmlspecialchars($_GET['modif']); ?> </p>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="column"><label>Nom :</label></div>
                    <div class="column-begin"><input type="text" name="nom" value="<?php echo htmlspecialchars($tuteur->getNomUti()); ?>"></div>
                </div>
                <div class="row">
                    <div class="column"><label>Prénom :</label></div>
                    <div class="column-begin"><input type="text" name="prenom" value="<?php echo htmlspecialchars($tuteur->getPreUti()); ?>"></div>
                </div>
                <div class="row">
                    <div class="column"><label>Téléphone :</label></div>
                    <div class="column-begin"><input type="text" name="telephone" value="<?php echo htmlspecialchars($tuteur->getTelUti()); ?>"></div>
                </div>
                <div class="row">
                    <div class="column"><label>Mail :</label></div>
                    <div class="column-begin"><input type="text" name="mail" value="<?php echo htmlspecialchars($tuteur->getMailUti()); ?>"></div>
                </div>
                <div class="row">
                    <div class="button-confirmer">
                        <input type="submit" value="Confirmer">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>