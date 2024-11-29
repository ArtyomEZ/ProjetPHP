    INSERT INTO Specialite (nomSpe) VALUES
    ('Informatique'),
    ('Mathématiques'),
    ('Francais'),
    ('Economie');

    INSERT INTO Type_Utilisateur (typUser) VALUES
    ('Étudiant'),
    ('Tuteur'),
    ('Administrateur');

    INSERT INTO Entreprise (nomEnt, adrEnt, cpEnt, vilEnt) VALUES
    ('TechInnov', '12 Rue des Inventions','75008', 'Paris'),
    ('BioLab Sciences', '8 Avenue de la Recherche', '69100', 'Villeurbanne'),
    ('Mécatronix', '22 Rue des Ingénieurs','31000', 'Toulouse');

    INSERT INTO Classe (nomCla, maxEtuCla) VALUES
    ('3 Olen', 30),
    ('4 Olen', 25),
    ('5 Olen', 20);

    INSERT INTO Maitre_Apprentissage (nomMai, preMai, telMai, mailMai, idEnt) VALUES
    ('Dupont', 'Jean', '0612345678', 'jean.dupont@techinnov.com', 1),
    ('Martin', 'Claire', '0623456789', 'claire.martin@biolab.com', 2),
    ('Leclerc', 'Paul', '0634567890', 'paul.leclerc@mecatronix.com', 3);

    INSERT INTO Utilisateur (nomUti, preUti, mailUti, telUti, adrUti, cpUti, vilUti, logUti, mdpUti, altUti, nbrMaxEtu3, nbrMaxEtu4, nbrMaxEtu5, idTypUser, idSpe, idCla, idEnt, idMai, idTut) VALUES
    ('Dubois', 'Alice', 'alice.dubois@etu.univ.fr', '0701234567', '10 Rue des Écoles', '75006', 'Paris', 'alice.dubois', 'password123', 1, NULL, NULL, NULL, 1, 1, 1, 1, 1, NULL),
    ('Morel', 'Benoît', 'benoit.morel@etu.univ.fr', '0712345678', '14 Rue des Étudiants', '69007', 'Lyon', 'benoit.morel', 'secure456', 0, NULL, NULL, NULL, 2, NULL, 1, 1,NULL,NULL),
    ('Lemoine', 'Chloé', 'chloe.lemoine@etu.univ.fr', '0723456789', '18 Avenue des Sciences', '34000', 'Montpellier', 'chloe.lemoine', 'mysecret789', 0, NULL, NULL, NULL, 3, NULL, NULL, NULL,NULL,NULL);

    INSERT INTO Bilan1 (notEnt1, notDos1, notOral1, rema1, datBil1, idUti) VALUES
    (16.5, 15.0, 16.0, 'Incroyable.', '2024-05-15', 1),
    (14.0, 13.0, 12.5, 'Bon travail.', '2024-06-10', 2),
    (10.0, 9.0, 8.5, 'Peut mieux faire.', '2024-07-20', 3);

    INSERT INTO Bilan2 (notDos2, notOral2, rema2, sujMem, datBil2, idUti) VALUES
    (15.0, 14.5, 'Bon travail global.', 'Optimisation d''algorithmes', '2024-09-15', 1),
    (13.0, 12.5, 'Peut approfondir.', 'Analyse statistique', '2024-10-10', 2),
    (17.0, 16.5, 'Excellent niveau.', 'Biotechnologies', '2024-11-20', 3);

    INSERT INTO Alerte (datLim1, datLim2) VALUES
    ('2024-11-01', '2024-11-15'),
    ('2024-12-01', '2024-12-10'),
    ('2024-12-15', '2024-12-20');
