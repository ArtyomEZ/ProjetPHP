<?php

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
require_once '../Modele\BO\Alerte.php';
require_once '../Modele\DAO\AlerteDAO.php';


//Test crud specialité :
$bdd = initialiseConnexionBDD();
//$specialiteDAO = new SpecialiteDAO($bdd);
//
////  test du Create
//$specialite = new Specialite(2, "La SVT");
//
//if ($specialiteDAO->Create($specialite)) {
//    echo "La spécialité a été ajoutée avec succès.";
//} else {
//    echo "Une erreur s'est produite lors de l'ajout de la spécialité.";
//}
////  test du getbyid
////$specialite = $specialiteDAO->GetById(2);
////var_dump($specialite);
////if($specialite == null){
////    echo 'ya pas de spe pour cet id';
////}
//
//$MesSpecialites = $specialiteDAO->GetAll();
//var_dump($MesSpecialites);

//  Test Update
//$majSpe = new Specialite(2, "Biologie");
//if ($specialiteDAO->Update($majSpe)) {
//    echo "La spécialité a été mise à jour avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la mise à jour de la spécialité.\n";
//}

// Test Delete (Suppression d'une spécialité)
//if ($specialiteDAO->Delete(2)) {
//    echo "La spécialité a été supprimée avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la suppression de la spécialité.\n";
//}

//test CRUD CLASSEDAO

//$classeDAO = new ClasseDAO($bdd);
//$classe = new Classe(1, "Informatique", 30);
//if ($classeDAO->Create($classe)) {
//    echo "La classe a été ajoutée avec succès.";
//} else {
//    echo "Une erreur s'est produite lors de l'ajout de la classe.";
//}
//
//$classe = $classeDAO->GetById(1);
//if ($classe) {
//    var_dump($classe);
//} else {
//    echo "Classe non trouvée.";
//}
//$classe = new Classe('1','burger',20);
//if ($classeDAO->Update($classe)) {
//    echo "La classe a été mise à jour.";
//} else {
//    echo "Erreur lors de la mise à jour de la classe.";
//}

//if ($classeDAO->Delete(1)) {
//    echo "La classe a été supprimée.";
//} else {
//    echo "Erreur lors de la suppression de la classe.";
//}

// CRUD ENTREPRISE

$entrepriseDAO = new EntrepriseDAO($bdd);

// Test du Create
//$entreprise = new Entreprise(4, "test", "test", "test", "test");
//if ($entrepriseDAO->Create($entreprise)) {
//    echo "L'entreprise a été ajoutée avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de l'ajout de l'entreprise.\n";
//}
//$entrepriseRecup = $entrepriseDAO->GetById(1);
//var_dump($entrepriseRecup);

//$MesEntreprises = $entrepriseDAO->GetAll();
//var_dump($MesEntreprises);
//
//$majEntreprise = new Entreprise(1, "zaza", "zaza", "007", "zaza");
//if ($entrepriseDAO->Update($majEntreprise)) {
//    echo "L'entreprise a été mise à jour avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la mise à jour de l'entreprise.\n";
//}
//if ($entrepriseDAO->Delete(3)) {
//    echo "L'entreprise a été supprimée avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la suppression de l'entreprise.\n";
//}
//  CRUD MAITRE APP
//$ent = $entrepriseDAO->GetById(4);
//$MaitreApprentissageDAO = new MaitreApprentissageDAO($bdd);
//
//$MaitreApprentissage = new MaitreApprentissage(5, "test", "test", "test", "test",$ent);
//if ($MaitreApprentissageDAO->Create($MaitreApprentissage)) {
//    echo "Le maitre d'app a été ajoutée avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de l'ajout du maitre.\n";
//}
//$MaitreApprentissage = $MaitreApprentissageDAO->GetById(1);
//var_dump($MaitreApprentissage);
//$MesEntreprises = $entrepriseDAO->GetAll();
//var_dump($MesEntreprises);

//$majMaitreApprentissage = new MaitreApprentissage(13, "saadia", "zak", "06", "zak",$ent);
//if ($MaitreApprentissageDAO->Update($majMaitreApprentissage)) {
//    echo "Le Maitre d'Apprentissage a été mise à jour avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la mise à jour du Maitre d'Apprentissage.\n";
//}
//
//if ($MaitreApprentissageDAO->Delete(13)) {
//    echo "Le Maitre d'apprentissage a été supprimée avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la suppression de l'entreprise.\n";
//}

//CRUD ADMINISTRATEUR

$adminDAO = new AdministrateurDAO($bdd );
//$monAdmin = new Administrateur(3,"b","b","b","b","b","b","bb","bbb","");
//if ($adminDAO->Create($monAdmin)) {
//    echo "L'Administrateur a été ajoutée avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de l'ajout de l'Administrateur.\n";
//}
//
//$eladmin = $adminDAO->GetById(1);
//var_dump($eladmin);

//$lesadmin = $adminDAO->GetAll();
//var_dump($lesadmin);

//$majAdmin = new Administrateur(15, "zaza", "zaza", "007", "zaza","za","za","zaza","zaza","zaza");
//if ($adminDAO->Update($majAdmin)) {
//    echo "L'admin a été mise à jour avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la mise à jour de l'admin.\n";
//}

//if ($adminDAO->Delete(15)) {
//    echo "L'admin a été supprimée avec succès.\n";
//} else {
//    echo "Une erreur s'est produite lors de la suppression de l'admin.\n";
//}


//LEBAZARD

//
//
//$tuteur = new Tuteur(3,2,1,2,"yoboy","zaza","zaza","zaza","zaza","zaza","zaza","zaza","zaaz");
//$classe = new Classe(1, 'Classe 1', 30);

//
//$d1 = new DateTime('2024-08-15');

//
//
//$etudiant = new Etudiant(false,$tuteur,$classe,$maitreappa,$specialite, (array)$bilan1, (array)$bilan2,2,"jean","bog","zaza","zaza","zaza","zaza","zaza","zaza","zaza");
//$bilan1 = new Bilan1($d1,10,10,10,10,10,"zaza",$etudiant);
//$bilan2 = new Bilan2("zaza",$d1,5,9,9,9,"idiot",$etudiant);

//if ($bilan2DAO->create($bilan2)) {
//    echo "Étudiant créé avec succès.";
//} else {
//    echo "Erreur lors de la création de l'étudiant.";
//}

////





//
////
//
//
////
//if ($etudiantDAO->create($etudiant)) {
//    echo "Étudiant créé avec succès.";
//} else {
//    echo "Erreur lors de la création de l'étudiant.";
//}
$tuteurDAO = new DAO\TuteurDAO($bdd);
//
////
//$lestuteurs = $tuteurDAO->getById(2);
//var_dump($lestuteurs);
//$mestuteurs = new Tuteur(5,5,5,10,"prime","yanis","yngmail","007","zaza","zaza","za","ee","ee");
//if ($tuteurDAO->Create($mestuteurs)) {
//    echo "ok\n";
//} else {
//    echo "ko\n";
//}
//$mestuteurs = $tuteurDAO->GetAll();
//var_dump($mestuteurs);
//$majtuteur = new Tuteur(1,2,3,17,"jules","greffet","jlgmail","025256548","14","45","zaza","ed","za");
//if ($tuteurDAO->Update($majtuteur)) {
//    echo "ok\n";
//} else {
//    echo "ko\n";
//}
//
//if ($tuteurDAO->Delete(17)) {
//    echo "ok\n";
//} else {
//    echo "ko\n";
//}



//if ($bilan1DAO->Create($bilan1)) {
//    echo "ok\n";
//} else {
//    echo "ko.\n";
//}
//$monbilan1 = $bilan1DAO->getById(2);
//var_dump($monbilan1);
//$elbilan1 = $bilan1DAO->GetAll();
//var_dump($elbilan1);
//$majbil1 = new Bilan1($datvis1,10,7,10,10,10,"fdp",$monetudiant);
//if ($bilan1DAO->Update($majbil1)) {
//    echo "ok\n";
//} else {
//    echo "ko\n";
//}
//if ($bilan1DAO->Delete(7)) {
//    echo "ok\n";
//} else {
//    echo "ko\n";
//}
//ETUDIANT BOSS FINAL
$maspecialite = new Specialite(1, 'Informatique');
$monentr= new Entreprise(1,"test","test","test","test",);
$monmaitreappa = new MaitreApprentissage(2, 'John',"burg","06","zaza",$monentr);
$maclasse = new Classe(1, 'Classe 2', 30);
$datvis1 = new DateTime('2024-04-24');
$datbil2 = new DateTime('2024-12-08');
$montuteur = new Tuteur(1,1,1,5,"test","test","test","test","test","test","test","test","test");
$monetudiant = new Etudiant(false,$entrepriseRecup = $entrepriseDAO->GetById(2),$lestuteurs = $tuteurDAO->getById(2),$maclasse,$monmaitreappa,$maspecialite,null,null,16,"tg","tg","tg","tg","tg","tg","tg","tg","tg");
$bilan1 = new Bilan1($datvis1,10,20,10,10,"testupdate",$monetudiant);
$bilan2 = new Bilan2("lesujetmemoire",$datbil2,7,2,2,"gwenni",$monetudiant);
$monetudiant->setMonBilan1($bilan1);
$monetudiant->setMonBilan2($bilan2);
$bilan2DAO = new Bilan2DAO($bdd);
$bilan1DAO = new Bilan1DAO($bdd);
$etudiantDAO = new EtudiantDAO($bdd);
//if ($etudiantDAO->Create($monetudiant)) {
//    echo "ok\n";
//} else {
//    echo "ko.\n";
//}
$eletudiant = $etudiantDAO->getById(9);
var_dump($eletudiant);
//var_dump($monetudiant);
//$eletudiant = $etudiantDAO->GetAll();
//var_dump($eletudiant);
//$monbilan1 = $bilan1DAO->getById(10);
//var_dump($monbilan1);
//$e = new Etudiant(false,$entrepriseRecup = $entrepriseDAO->GetById(1),$lestuteurs = $tuteurDAO->getById(3),$maclasse,$monmaitreappa,$maspecialite,null,null,16,"a","a","a","a","a","a","a","a","a");
//if ($etudiantDAO->Update($e)) {
//    echo "ok\n";
//} else {
//    echo "ko\n";
//}
//if ($etudiantDAO->create($monetudiant)) {
//    echo "Étudiant créé avec succès.";
//} else {
//    echo "Erreur lors de la création de l'étudiant.";
//}
//if ($bilan2DAO->create($bilan2)) {
//    echo "ok";
//} else {
//    echo "ko";
//}
//if ($etudiantDAO->Delete(11)) {
//    echo "ok\n";
//} else {
//    echo "ko\n";
//}
///methode pour avoir tt les etudiant dun tuteur
//$lesetudestuteurs = $tuteurDAO->getEtuByTut(2);
//var_dump($lesetudestuteurs);
//ALERTE TEST
//$AlerteDAO = new AlerteDAO($bdd);
//$pnl = $AlerteDAO->getAlertesBilan2Tuteur($lestuteurs = $tuteurDAO->getById(2));
//var_dump($pnl);
