<?php
include 'headerAdmin.php';
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres Étudiant & Tuteur</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="content">
    <h1>Paramètres</h1>

    <div class="row">
        <!-- Section Nouvel Étudiant -->
        <div class="column">
            <h2>Nouvel Étudiant</h2>
            <form class="form-style">
                <label>Nom:</label>
                <input type="text" placeholder="Nom">
                <label>Prénom:</label>
                <input type="text" placeholder="Prénom">
                <label>Téléphone:</label>
                <input type="text" placeholder="Téléphone">
                <label>Adresse:</label>
                <input type="text" placeholder="Adresse">
                <label>Mail:</label>
                <input type="email" placeholder="Mail">
                <input type="submit" value="Confirmer" class="button">
            </form>
        </div>

        <!-- Section Nouveau Tuteur -->
        <div class="column">
            <h2>Nouveau Tuteur</h2>
            <form class="form-style">
                <label>Nom:</label>
                <input type="text" placeholder="Nom">
                <label>Prénom:</label>
                <input type="text" placeholder="Prénom">
                <label>Téléphone:</label>
                <input type="text" placeholder="Téléphone">
                <label>Mail:</label>
                <input type="email" placeholder="Mail">
                <label>Classe:</label>
                <select>
                    <option value="">Choisir une classe</option>
                </select>
                <input type="submit" value="Confirmer" class="button">
            </form>
        </div>
    </div>

    <hr>

    <!-- Section Entreprise -->
    <div class="row">
        <div class="column greyboxEt">
            <h2>Entreprise (optionnel)</h2>
            <form class="form-style">
                <label>Nom:</label>
                <input type="text" placeholder="Nom">
                <label>Adresse:</label>
                <input type="text" placeholder="Adresse">
                <label>Code Postal:</label>
                <input type="text" placeholder="Code Postal">
                <label>Ville:</label>
                <input type="text" placeholder="Ville">
                <label>Nom Maître d'Apprentissage:</label>
                <input type="text" placeholder="Nom Maître d'Apprentissage">
                <label>Prénom Maître d'Apprentissage:</label>
                <input type="text" placeholder="Prénom Maître d'Apprentissage">
                <label>Téléphone Maître d'Apprentissage:</label>
                <input type="text" placeholder="Téléphone">
                <label>Mail Maître d'Apprentissage:</label>
                <input type="email" placeholder="Mail">
                <input type="submit" value="Confirmer" class="button">
            </form>
        </div>
    </div>
</main>
</body>
</html>