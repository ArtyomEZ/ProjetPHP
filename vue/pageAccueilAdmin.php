<?php
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error='.($error));
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/pageAcceuilAdmin.css">
    <title>Accueil</title>
</head>
<body>
<?php
include("../vue/headerAdmin.php");
include("../vue/alertesAdmin.php");
include("../vue/listeEleves.php");
?>
<a href="parametreAdmin.php">Paramètre Admin</a>
<br>
<br>

<a href="pageGestionTuteur.php"> Gestion Tuteur</a>
<br>
<br>
<a href="affectationTuteurs.php"> Affectation Tuteur </a>
<br>
<br>
<a href="pageParametresGeneraux.php">Paramètre Généraux </a>


<br>
<br>
</body>
</html>