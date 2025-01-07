<?php

require_once 'init.php';
if (isset($_SESSION['login']) || $_SESSION['role'] !== 'tuteur') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}


include 'headerTuteur.php';


require_once '../Modele\BDDManager.php';
require_once '../Modele\DAO\SpecialiteDAO.php';
require_once '../Modele\BO\Specialite.php';
require_once '../Modele\DAO\ClasseDAO.php';
require_once '../Modele\BO\Classe.php';
require_once '../Modele\DAO\EntrepriseDAO.php';
require_once '../Modele\BO\Entreprise.php';
require_once '../Modele\DAO\MaitreApprentissageDAO.php';
require_once '../Modele\BO\MaitreApprentissage.php';
require_once '../Modele\DAO\AdministrateurDAO.php';
require_once '../Modele\BO\Administrateur.php';
require_once '../Modele\BO\Utilisateur.php';
require_once '../Modele\BO\Bilan.php';
require_once '../Modele\BO\Bilan1.php';
require_once '../Modele\BO\Bilan2.php';
require_once '../Modele\DAO\Bilan1DAO.php';
require_once '../Modele\DAO\Bilan2DAO.php';
require_once '../Modele\BO\Tuteur.php';
require_once '../Modele\DAO\TuteurDAO.php';
require_once '../Modele\DAO\EtudiantDAO.php';
require_once '../Modele\BO\Etudiant.php';

$bdd = initialiseConnexionBDD();
$tuteurDAO = new DAO\TuteurDAO($bdd);

$tuteurId = $_SESSION['user_id'];
$tuteur = $tuteurDAO->getById($tuteurId);
if (!$tuteur) {
    $error = 'Tuteur introuvable';
    header('Location: ../vue/MesinfosTuteur.php?error=' . urlencode($error));
    exit;
}
?>


    <HTML>
<head>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<div class="content">

    <div class="greyboxEt">
        <h1>Profil Tuteur</h1>
        <div class="whitebox">
            <form action="../controleur/ControlerUpdateTuteur.php" method="post">
                <?php if (isset($_GET['error'])): ?>
                    <p style="color: red;"><?= htmlspecialchars($_GET['error']); ?></p>
                <?php endif; ?>
                <?php if (isset($_GET['modif'])): ?>
                    <p style="color: green;"><?= htmlspecialchars($_GET['modif']); ?></p>
                <?php endif; ?>
                <input type="hidden" name="idEtudiant" value="<?php echo htmlspecialchars($tuteur->getIdUti()); ?>">
                <div class="row">
                    <div class="column">
                        <label>Nom :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" name="nom" value="<?php echo htmlspecialchars($tuteur->getNomUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Prénom :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" name="prenom"  value="<?php echo htmlspecialchars($tuteur->getPreUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Téléphone :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text"  name="telephone" value="<?php echo htmlspecialchars($tuteur->getTelUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Mail :</label>
                    </div>
                    <div class="column-begin">
                        <input type="text" name="mail"  value="<?php echo htmlspecialchars($tuteur->getMailUti()); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class ="button">
                        <input type="submit" value="Confirmer" >
                    </div>
                </div>
            </form>



            <br>
            <br>
            <br>
        </div>
    </div>
</div>
</body>
    </HTML><?php