<?php
require_once 'init.php';
if (isset($_SESSION['login']) || $_SESSION['role'] !== 'tuteur') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error='.($error));
    exit;
}
?>

<div class="header-style">
    <div class="row">
<!--        <div class="column">-->
<!--        </div>-->
        <div class="column">
            <img src="../img/FSI_logo.png" alt="Logo FSI" class="header-logo">
        </div>
        <div class="column">
            <a href="">
                <p>Accueil</p>
            </a>
        </div>
        <div class="column">
            <a href="MesinfoTuteur.php">
                <p>Mes informations</p>
            </a>
        </div>
        <div class="column">
        </div>
        <div class="column-end">
            <form action="../controleur/ControleurDeco.php">
                <input type="submit" value="Se Déconnecter" >
            </form>
        </div>
<!--        <div class="column">-->
<!--        </div>-->
    </div>
</div>