<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <title>Connexion</title>
</head>
<body class="connexion">
<div class="row">
    <div class="column">
        <div class="form-style">
            <form action="../controleur/ControllerConnexion.php" method="POST">

                <div class="row">
                    <div class="column">
                        <label>Identifiant:</label>
                    </div>
                    <div class="column-begin">
                        <label>
                            <input type="text" name="login">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Mot de Passe:</label>
                    </div>
                    <div class="column-begin">
                        <label>
                            <input type="password" name="password">
                        </label>
                    </div>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <p style="color: red;"><?= htmlspecialchars($_GET['error']); ?></p>
                <?php endif; ?>
                <div class="row">
                    <input type="submit" value="Confirmer">
                </div>
            </form>
        </div>
    </div>
    <div class="column">
        <img src="../img/FSI_logo.png" alt="Logo FSI" class="img-30pc">
    </div>
</div>
</body>
</html>