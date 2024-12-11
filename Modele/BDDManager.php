<?php

function initialiseConnexionBDD() {
    $bdd = null;
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=P2025_2SIO_Projet_Tutorat;charset=utf8',
            'root',
            ''
        );
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        die('Erreur connexion BDD : '.$e->POSTMessage());
    }

    return $bdd;
}

