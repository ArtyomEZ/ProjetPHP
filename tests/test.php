<?php

use BO\Administrateur;
use BO\Classe;
use BO\Entreprise;
use BO\Etudiant;
use BO\MaitreApprentissage;
use BO\Specialite;
use BO\Tuteur;
use BO\Utilisateur;
use DAO\AdministrateurDAO;
use DAO\ClasseDAO;
use DAO\EntrepriseDAO;
use DAO\MaitreApprentissageDAO;
use DAO\SpecialiteDAO;

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


////Test crud specialité :
$bdd = initialiseConnexionBDD();
$specialiteDAO = new SpecialiteDAO($bdd);

//  test du Create
$specialite = new Specialite(15, "La SVTttt");

if ($specialiteDAO->Create($specialite)) {
    echo "La spécialité a été ajoutée avec succès.";
} else {
    echo "Une erreur s'est produite lors de l'ajout de la spécialité.";
}
//////  test du getbyid
//////$specialite = $specialiteDAO->GetById(2);
//////var_dump($specialite);
//////if($specialite == null){
//////    echo 'ya pas de spe pour cet id';
//////}
////
////$MesSpecialites = $specialiteDAO->GetAll();
////var_dump($MesSpecialites);
//
////  Test Update
////$majSpe = new Specialite(2, "Biologie");
////if ($specialiteDAO->Update($majSpe)) {
////    echo "La spécialité a été mise à jour avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la mise à jour de la spécialité.\n";
////}
//
//// Test Delete (Suppression d'une spécialité)
////if ($specialiteDAO->Delete(2)) {
////    echo "La spécialité a été supprimée avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la suppression de la spécialité.\n";
////}
//
////test CRUD CLASSEDAO
//
////$classeDAO = new ClasseDAO($bdd);
////$classe = new Classe(1, "Informatique", 30);
////if ($classeDAO->Create($classe)) {
////    echo "La classe a été ajoutée avec succès.";
////} else {
////    echo "Une erreur s'est produite lors de l'ajout de la classe.";
////}
////
////$classe = $classeDAO->GetById(1);
////if ($classe) {
////    var_dump($classe);
////} else {
////    echo "Classe non trouvée.";
////}
////$classe = new Classe('1','burger',20);
////if ($classeDAO->Update($classe)) {
////    echo "La classe a été mise à jour.";
////} else {
////    echo "Erreur lors de la mise à jour de la classe.";
////}
//
////if ($classeDAO->Delete(1)) {
////    echo "La classe a été supprimée.";
////} else {
////    echo "Erreur lors de la suppression de la classe.";
////}
//
//// CRUD ENTREPRISE
//
//$entrepriseDAO = new EntrepriseDAO($bdd);
//
//// Test du Create
////$entreprise = new Entreprise(13, "a", "a", "007", "a");
////if ($entrepriseDAO->Create($entreprise)) {
////    echo "L'entreprise a été ajoutée avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de l'ajout de l'entreprise.\n";
////}
////$entrepriseRecup = $entrepriseDAO->GetById(1);
////var_dump($entrepriseRecup);
//
////$MesEntreprises = $entrepriseDAO->GetAll();
////var_dump($MesEntreprises);
////
////$majEntreprise = new Entreprise(1, "zaza", "zaza", "007", "zaza");
////if ($entrepriseDAO->Update($majEntreprise)) {
////    echo "L'entreprise a été mise à jour avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la mise à jour de l'entreprise.\n";
////}
////if ($entrepriseDAO->Delete(1)) {
////    echo "L'entreprise a été supprimée avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la suppression de l'entreprise.\n";
////}
////  CRUD MAITRE APP
//$ent = $entrepriseDAO->GetById(1);
//$MaitreApprentissageDAO = new MaitreApprentissageDAO($bdd);
//
////$MaitreApprentissage = new MaitreApprentissage(13, "a", "a", "007", "a",$ent);
////if ($MaitreApprentissageDAO->Create($MaitreApprentissage)) {
////    echo "Le maitre d'app a été ajoutée avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de l'ajout du maitre.\n";
////}
////$MaitreApprentissage = $MaitreApprentissageDAO->GetById(1);
////var_dump($MaitreApprentissage);
////$MesEntreprises = $entrepriseDAO->GetAll();
////var_dump($MesEntreprises);
//
////$majMaitreApprentissage = new MaitreApprentissage(13, "saadia", "zak", "06", "zak",$ent);
////if ($MaitreApprentissageDAO->Update($majMaitreApprentissage)) {
////    echo "Le Maitre d'Apprentissage a été mise à jour avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la mise à jour du Maitre d'Apprentissage.\n";
////}
////
////if ($MaitreApprentissageDAO->Delete(13)) {
////    echo "Le Maitre d'apprentissage a été supprimée avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la suppression de l'entreprise.\n";
////}
//
////CRUD ADMINISTRATEUR
//
//$adminDAO = new AdministrateurDAO($bdd );
////$monAdmin = new Administrateur(3,"b","b","b","b","b","b","bb","bbb","");
////if ($adminDAO->Create($monAdmin)) {
////    echo "L'Administrateur a été ajoutée avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de l'ajout de l'Administrateur.\n";
////}
////
////$eladmin = $adminDAO->GetById(1);
////var_dump($eladmin);
//
////$lesadmin = $adminDAO->GetAll();
////var_dump($lesadmin);
//
////$majAdmin = new Administrateur(15, "zaza", "zaza", "007", "zaza","za","za","zaza","zaza","zaza");
////if ($adminDAO->Update($majAdmin)) {
////    echo "L'admin a été mise à jour avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la mise à jour de l'admin.\n";
////}
//
////if ($adminDAO->Delete(15)) {
////    echo "L'admin a été supprimée avec succès.\n";
////} else {
////    echo "Une erreur s'est produite lors de la suppression de l'admin.\n";
////}
//
//
////LEBAZARD
//$tuteur = new Tuteur(3,2,1,2,"yoboy","zaza","zaza","zaza","zaza","zaza","zaza","zaza","zaaz");
//$classe = new Classe(1, 'Classe 1', 30);
//$specialite = new Specialite(1, 'Informatique');
//
//////
//$etudiant = new Etudiant(1, 'NomEtudiant', 'PrenomEtudiant', 'email@etudiant.com', '0102030406', 'Adresse Etudiant', '75000', 'Paris', 'logEtudiant', 'mdpEtudiant', true, $tuteur, $classe, $specialite,"zaza","zaza","zaza");
////
//////
////$etudiantDAO = new DAO\EtudiantDAO($bdd);
////
//////
////if ($etudiantDAO->create($etudiant)) {
////    echo "Étudiant créé avec succès.";
////} else {
////    echo "Erreur lors de la création de l'étudiant.";
////}
$tuteurDAO = new DAO\TuteurDAO($bdd);

//
$lestuteurs = $tuteurDAO->getById(2);
var_dump($lestuteurs);





