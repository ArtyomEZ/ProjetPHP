<?php

use DAO\TuteurDAO;


include "headerAdmin.php";
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

require_once '../Modele/BddManager.php';
require_once '../Modele/DAO/TuteurDAO.php';
require_once '../Modele\BO\Tuteur.php';
require_once '../Modele\BO\Utilisateur.php';

$bdd = initialiseConnexionBDD();
$tuteurdao = new TuteurDAO($bdd);

$tuteur = $tuteurdao->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tuteurs</title>
    <link type="text/css" rel="stylesheet" href="../css/style4.css">
</head>
<div class="content">
    <h1>Liste des Tuteurs</h1>
    <div class="greybox">
        <div class="whitebox">
            <p><?php if (isset($_GET['error'])): ?>
            <p style="color: red;"> <?= htmlspecialchars($_GET['error']); ?> </p>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <p style="color: green;"> <?= htmlspecialchars($_GET['success']); ?> </p>
            <?php endif; ?>
            </p>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($tuteur as $pnl) : ?>
                    <tr>
                        <td><?php echo $pnl->getNomUti(); ?></td>
                        <td><?php echo $pnl->getPreUti(); ?></td>
                        <td><a href="modifierTuteur.php?id=<?php echo $pnl->getidUti(); ?>" style="color: blue;">+Modifier</a></td>
                        <td><a href="../controleur/ControlerDeleteTuteur.php?id=<?php echo $pnl->getidUti(); ?>" style="color: blue;">+Supprimer</a></td>
                    </tr>
                    <tr>
                        <td colspan="4" ><hr></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
