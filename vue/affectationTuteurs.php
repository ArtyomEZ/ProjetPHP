<?php
require_once 'init.php';

if (isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    $error = 'Permissions insuffisantes.';
    header('Location: ../vue/pageConnexion.php?error=' . ($error));
    exit;
}

use BO\Administrateur;
use BO\Bilan;
use BO\Bilan1;
use BO\Bilan2;
use BO\Classe;
use BO\Entreprise;
use BO\Etudiant;
use BO\MaitreApprentissage;
use BO\Specialite;
use BO\Tuteur;
use BO\Utilisateur;
use DAO\AdministrateurDAO;
use DAO\AlerteDAO;
use DAO\Bilan1DAO;
use DAO\Bilan2DAO;
use DAO\ClasseDAO;
use DAO\EntrepriseDAO;
use DAO\EtudiantDAO;
use DAO\MaitreApprentissageDAO;
use DAO\SpecialiteDAO;
use DAO\TuteurDAO;

include "headerAdmin.php";
require_once '../Modele/BDDManager.php';
require_once '../Modele/DAO/SpecialiteDAO.php';
require_once '../Modele/BO/Specialite.php';
require_once '../Modele/DAO/ClasseDAO.php';
require_once '../Modele/BO/Classe.php';
require_once '../Modele/DAO/EntrepriseDAO.php';
require_once '../Modele/BO/Entreprise.php';
require_once '../Modele/DAO/MaitreApprentissageDAO.php';
require_once '../Modele/BO/MaitreApprentissage.php';
require_once '../Modele/DAO/AdministrateurDAO.php';
require_once '../Modele/BO/Administrateur.php';
require_once '../Modele/BO/Utilisateur.php';
require_once '../Modele/BO/Bilan.php';
require_once '../Modele/BO/Bilan1.php';
require_once '../Modele/BO/Bilan2.php';
require_once '../Modele/DAO/Bilan1DAO.php';
require_once '../Modele/DAO/Bilan2DAO.php';
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';
require_once '../Modele/DAO/EtudiantDAO.php';
require_once '../Modele/BO/Etudiant.php';
require_once '../Modele/BO/Alerte.php';
require_once '../Modele/DAO/AlerteDAO.php';

// Initialisation des objets DAO
$bdd = initialiseConnexionBDD();
$etudiantdao = new EtudiantDAO($bdd);
$tuteurDAO = new TuteurDAO($bdd);

// Récupération des étudiants et tuteurs
$etudiants = $etudiantdao->getAll();
$tuteurs = $tuteurDAO->getAll();

// Récupérer le tuteur sélectionné (idTuteur)
$tuteurId = null;
if (isset($_POST['tuteur_id']) && !empty($_POST['tuteur_id'])) {
    $tuteurId = $_POST['tuteur_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assignation du tuteur à un étudiant
    if (isset($_POST['assign_tuteur']) && !empty($_POST['etudiant_id']) && !empty($_POST['tuteur_id'])) {
        $etudiantId = $_POST['etudiant_id'];
        $tuteurId = $_POST['tuteur_id'];

        // Logique pour affecter un tuteur
        if ($etudiantdao->assignerTuteur($etudiantId, $tuteurId)) {
            $message = "Tuteur assigné avec succès.";
        } else {
            $message = "Erreur lors de l'assignation du tuteur.";
        }
    }
    // Désassignation du tuteur d'un étudiant
    elseif (isset($_POST['unassign_tuteur']) && !empty($_POST['etudiant_id'])) {
        $etudiantId = $_POST['etudiant_id'];

        // Logique pour désaffecter un tuteur
        if ($etudiantdao->desassignerTuteur($etudiantId)) {
            $message = "Tuteur désassigné avec succès.";
        } else {
            $message = "Erreur lors de la désassignation du tuteur.";
        }
    }
}

?>

<link rel="stylesheet" href="../css/style5.css">

<div class="content">
    <div class="row">
        <div class="column">Tuteur :</div>
        <div class="column-begin">
            <form method="post" action="">
                <select name="tuteur_id" id="tuteur" onchange="this.form.submit()">
                    <option value="">Sélectionner un tuteur</option>
                    <?php
                    foreach ($tuteurs as $tuteur) {
                        $selected = ($tuteurId == $tuteur->getIdUti()) ? 'selected' : '';
                        echo "<option value='{$tuteur->getIdUti()}' $selected>{$tuteur->getNomUti()} {$tuteur->getPreUti()}</option>";
                    }
                    ?>
                </select>
            </form>
        </div>
    </div>

    <h1>Liste d'Étudiants</h1>
    <div class="greybox">
        <div class="whitebox">
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Mail</th>
                    <th>Spécialité</th>
                    <th>Classe</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($etudiants as $etudiant) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($etudiant->getNomUti()); ?></td>
                        <td><?php echo htmlspecialchars($etudiant->getPreUti()); ?></td>
                        <td><?php echo htmlspecialchars($etudiant->getTelUti()); ?></td>
                        <td><?php echo htmlspecialchars($etudiant->getMailUti()); ?></td>
                        <td><?php echo htmlspecialchars($etudiant->getMaSpecialite() ? $etudiant->getMaSpecialite()->getNomSpe() : 'Aucun'); ?></td>
                        <td><?php echo htmlspecialchars($etudiant->getMaClasse() ? $etudiant->getMaClasse()->getNomCla() : 'Aucun'); ?></td>
                        <td>
                            <?php
                            // Vérifier si l'étudiant est assigné au tuteur sélectionné
                            if ($tuteurId) {
                                if ($etudiant->getMonTuteur() && $etudiant->getMonTuteur()->getIdUti() == $tuteurId) {
                                    echo '<form method="post" action="">
                                            <input type="hidden" name="etudiant_id" value="' . $etudiant->getIdUti() . '">
                                            <input type="hidden" name="tuteur_id" value="' . $tuteurId . '">
                                            <input type="submit" name="unassign_tuteur" value="Désassigner ce tuteur">
                                          </form>';
                                } else {
                                    echo '<form method="post" action="">
                                            <input type="hidden" name="etudiant_id" value="' . $etudiant->getIdUti() . '">
                                            <input type="hidden" name="tuteur_id" value="' . $tuteurId . '">
                                            <input type="submit" name="assign_tuteur" value="Assigner ce tuteur">
                                          </form>';
                                }
                            } else {
                                echo 'Veuillez sélectionner un tuteur.';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php if (isset($message)): ?>
    <div class="alert"><?php echo $message; ?></div>
<?php endif; ?>

