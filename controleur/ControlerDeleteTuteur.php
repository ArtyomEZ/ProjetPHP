<?php



require_once '../vue/init.php';
require_once '../Modele/BddManager.php';
require_once '../Modele/BO/Utilisateur.php';
require_once '../Modele/BO/Tuteur.php';
require_once '../Modele/DAO/TuteurDAO.php';

session_start();


if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    $error = 'ID du tuteur invalide.';
    header('Location: ../vue/listeTuteurs.php?error=' . urlencode($error));
    exit;
}

$tuteurId = (int) $_GET['id'];

$bdd = initialiseConnexionBDD();
$tuteurDAO = new DAO\TuteurDAO($bdd);


// Vérifier si le tuteur a encore des étudiants



// Vérifier si le tuteur existe bien
$tuteur = $tuteurDAO->getById($tuteurId);
if (!$tuteur) {
    $error = 'Tuteur introuvable.';
    header('Location: ../vue/pageGestionTuteur.php?error=' . urlencode($error));
    exit;
}

// Tenter de supprimer le tuteur
try {
    $delete = $tuteurDAO->delete($tuteurId);
    if ($delete) {
        $success = 'Tuteur supprimé avec succès.';
        header('Location: ../vue/pageGestionTuteur.php?success=' . urlencode($success));
        exit;
    } else {
        throw new Exception('Erreur lors de la suppression du tuteur.');
    }
} catch (PDOException $e) {
    $error = 'Impossible de supprimer ce tuteur, veuillez lui retirer ces étudiants.';
    header('Location: ../vue/pageGestionTuteur.php?error=' . urlencode($error));
    exit;
} catch (Exception $e) {
    $error = $e->getMessage();
    header('Location: ../vue/pageGestionTuteur.php?error=' . urlencode($error));
    exit;
}

?>