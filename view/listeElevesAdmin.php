<?php

use BO\Administrateur;
use BO\Alerte;
use BO\Bilan;
use BO\Bilan1;
use BO\Bilan2;
use BO\Classe;
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


require_once '..\Modele/BDDManager.php';
require_once '..\Modele/DAO/SpecialiteDAO.php';
require_once '..\Modele/BO/Specialite.php';
require_once '..\Modele/DAO/ClasseDAO.php';
require_once '..\Modele/BO/Classe.php';
require_once '..\Modele/DAO/EntrepriseDAO.php';
require_once '..\Modele/BO/Entreprise.php';
require_once '..\Modele/DAO/MaitreApprentissageDAO.php';
require_once '..\Modele/BO/MaitreApprentissage.php';
require_once '..\Modele/DAO/AdministrateurDAO.php';
require_once '..\Modele/BO/Administrateur.php';
require_once '..\Modele/BO/Utilisateur.php';
require_once '..\Modele/BO/Bilan.php';
require_once '..\Modele/BO/Bilan1.php';
require_once '..\Modele/BO/Bilan2.php';
require_once '..\Modele/DAO/Bilan1DAO.php';
require_once '..\Modele/DAO/Bilan2DAO.php';
require_once '..\Modele/BO/Tuteur.php';
require_once '..\Modele/DAO/TuteurDAO.php';
require_once '..\Modele/DAO/EtudiantDAO.php';
require_once '..\Modele/BO/Etudiant.php';
require_once '..\Modele/BO/Alerte.php';
require_once '..\Modele/DAO/AlerteDAO.php';

    $bdd = initialiseConnexionBDD();
    $Eleves = new EtudiantDAO($bdd);
    $AAAAAAAA = new SpecialiteDAO($bdd);
    $eleve = $Eleves->getAll();
?>
<div class="content">
    <h1>Liste d'Etudiants</h1>
    <div class="greybox">
        <div class="whitebox">
            <table>
                <tr>
                    <th>
                        Nom
                    </th>
                    <th>
                        Prénom
                    </th>
                    <th>
                        Spécialité
                    </th>
                    <th>
                        Classe
                    </th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                foreach ($eleve as $etudiant) //parse les élèves avec $etudiant
                    {
                        $nom=$etudiant->getNomUti();
                        $prenom=$etudiant->getPreUti();
                        $specialite=$AAAAAAAA->getById($etudiant->getMaSpecialite());
                        $libSpecialite=$specialite->getNomSpe();
                        $classe=($etudiant->getmaClasse());
                        echo (
    "<tr>
        <td>".
            $nom.
        "</td>
        <td>".
            $prenom.
        "</td>
        <td>".
            $specialite.
        "</td>
        <td>".
            $classe.
        "</td>
        <td>
            <a href=\"\">+info</a>
        </td>
        <td>
            <a href=\"\">+modifier</a>
        </td>
    </tr>"
                    );}
                ?>
            </table>
        </div>
    </div>
</div>