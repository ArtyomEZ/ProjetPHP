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
    <link rel="stylesheet" href="../css/pageAccueilAdm.css">
    <title>Accueil</title>
</head>
<body>
<?php
include("../vue/headerAdmin.php");
include("../vue/alertesAdmin.php");
include("../vue/listeEleves.php");
?>
<a href="parametreAdmin.php">Paramètre générale</a>
<br>
<br>
</body>
</html>