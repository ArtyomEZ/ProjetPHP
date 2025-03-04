<?php
require_once 'init.php';
if (isset($_SESSION['login']) || $_SESSION['role'] !== 'etudiant') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error='.($error));
    exit;
}
?>



<div class="content">
    <h1>
        Bilans
    </h1>
    <div class="greybox">
        <div class="row">
            <div class="column">
                <div class="whitebox">
                    <br>
                    <h2>
                        Bilan 1
                    </h2>
                    <br>
                    <br>
                    <form action="bilan1.php">
                        <input type="submit" class="sub-center" value="Voir">
                    </form>
                    <br>
                </div>
            </div>
            <div class="column">
                <div class="whitebox">
                    <br>
                    <h2>
                        Bilan 2
                    </h2>
                    <br>
                    <br>
                    <form action="bilan2.php">
                        <input type="submit" class="sub-center" value="Voir">
                    </form>

                    <br>
                </div>
            </div>
        </div>
    </div>
</div>