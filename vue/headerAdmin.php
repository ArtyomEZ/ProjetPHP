<?php
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error='.($error));
    exit;
}
?>


<div class="header-style">
    <div class="row">
<!--        <div class="column">-->
<!--        </div>-->
        <div class="column-begin">
            <img src="../img/FSI_logo.png" alt="Logo FSI" class="header-logo">
        </div>
        <div class="columnAdmin">
            <a href="../vue/pageAccueilAdmin.php">
                <p>Accueil</p>
            </a>
        </div>
        <div class="column">
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