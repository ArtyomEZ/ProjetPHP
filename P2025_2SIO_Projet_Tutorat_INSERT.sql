    INSERT INTO Specialite (nomSpe) VALUES
    ('Informatique'),
    ('Mathématiques'),
    ('Francais');

    INSERT INTO TypeUtilisateur (typUser) VALUES
    ('Étudiant'),
    ('Tuteur'),
    ('Administrateur');

    INSERT INTO Entreprise (nomEnt, adrEnt, cpEnt, vilEnt) VALUES
    ('TechInnov', '12 Rue des Inventions','75008', 'Paris'),
    ('BioLab Sciences', '8 Avenue de la Recherche', '69100', 'Villeurbanne'),
    ('Cabottech', '5 Rue des cabots', '69002', 'Lyon'),
    ('ChickenSpot', '10 Boulevard des poulets', '69003', 'Lyon');

    INSERT INTO Classe (nomCla, maxEtuCla) VALUES
    ('3 Olen', 30),
    ('4 Olen', 25),
    ('5 Olen', 20);

    INSERT INTO MaitreApprentissage (nomMai, preMai, telMai, mailMai, idEnt) VALUES
    ('Dupont', 'Jean', '0612345678', 'jean.dupont@techinnov.com', 1),
    ('Martin', 'Claire', '0623456789', 'claire.martin@biolab.com', 1),
    ('Cabot', 'Robin', '0634567890', 'robin.cabot@cabottech.com', 2),
    ('Sanders','Colonel', '0645678901', 'colonel.sanders@chickenspot.com', 3);

    INSERT INTO Utilisateur (nomUti, preUti, mailUti, telUti, adrUti, cpUti, vilUti, logUti, mdpUti, altUti, nbrMaxEtu3, nbrMaxEtu4, nbrMaxEtu5, idTypUser, idSpe, idCla, idEnt, idMai, idTut) VALUES
    ('Bouquet', 'Yanis', 'yanis.bouquet@lyon.ort.fr', '0701231567', '4 rue des admins', '75002', '¨Paris', 'admin', 'admin123', NULL,NULL,NULL,NULL,3, NULL, NULL, NULL, NULL, NULL),
    ('Goudet', 'Magali', 'magali.goudet@lyon.ort.fr', '0701254567', '8 Rue des tuteurs', '69002', 'Lyon', 'magali.goudet', 'magali123',NULL, 20,20,20,2, NULL, NULL, NULL, NULL, NULL),
    ('Dupont', 'Arnaud', 'arnaud.dupont@lyon.ort.fr', '0712346678', '9 rue des tuteurs', '69002', 'Lyon', 'arnaud.dupont', 'arnaud123',NULL,20,20,20,2, NULL, NULL, NULL, NULL, NULL),
    ('Rahaimi', 'Oualid', 'oualid.rahaimi@lyon.ort.fr', '0712345478', '10 rue des tuteurs', '69002', 'Lyon', 'oualid.rahaimi', 'oualid123', NULL, 20, 20, 20, 2, NULL, NULL, NULL, NULL, NULL),
    ('Gharbi', 'Aymen', 'aymen.gharbi@lyon.ort.fr', '0701234567', '10 Rue des Écoles', '69008', 'Lyon', 'aymen.gharbi', 'aymen123', 1, NULL, NULL, NULL, 1, 1, 1, 1, 1, NULL),
    ('Zenasni', 'Hakim', 'hakim.zenasni@lyon.ort.fr', '0712345678', '14 Rue des Étudiants', '69007', 'Lyon', 'hakim.zenasni', 'hakim123', 0, NULL, NULL, NULL, 1, 1, 1, 1, 2, 2),
    ('Dupont', 'Dupond', 'dupont.dupont@lyon.ort.fr', '07012364517', '10 Rue des dupont', '69008', 'Lyon', 'dupont.dupond', 'dupont123', 1, NULL, NULL, NULL, 1, 2, 2, 2, 2, 3),
    ('Dupont', 'Xavier', 'xavier.dupont@lyon.ort.fr', '0712345677', '18 Rue des recherche', '69007', 'Lyon', 'xavier.dupont', 'xavier123', 0, NULL, NULL, NULL, 1, 1, 1, NULL, 3, 4),
    ('Lemoine', 'Chloé', 'chloe.lemoine@lyon.ort.fr', '0719876543', '12 Rue des Lumières', '69001', 'Lyon', 'chloe.lemoine', 'chloe123', 1, NULL, NULL, NULL, 1, 3, 2, 1, 2, 2),
    ('Morel', 'Benoît', 'benoit.morel@lyon.ort.fr', '0714567890', '7 Rue des Sciences', '69002', 'Lyon', 'benoit.morel', 'benoit123', 1, NULL, NULL, NULL, 1, 1, 3, 2, 3, 4);

    INSERT INTO Bilan1 (notEnt1, notDos1, notOral1, rema1, datBil1, idUti) VALUES
    (16.5, 15.0, 16.0, 'Incroyable.', '2025-01-01', 5),
    (14.0, 13.0, 12.5, 'Bon travail.', '2025-01-01', 6),
    (10.0, 9.0, 8.5, 'Peut mieux faire.', '2025-01-01', 7),
    (20.0, 20.0, 20.0, 'Excellent.', '2025-01-01', 8),
    (8.0, 19.0, 1.5, 'Montagnes russes.', '2025-01-01', 9),
    (5.0, 11.0, 13.0, 'Ensemble correct.', '2025-01-01', 10);

    INSERT INTO Bilan2 (notDos2, notOral2, rema2, sujMem, datBil2, idUti) VALUES
    (15.0, 18.5, 'Tres bon travail.', 'Optimisation algorithmes', '2025-06-01', 5),
    (13.0, 12.5, 'Peut approfondir.', 'Analyse statistique', '2025-06-01', 6),
    (7.0, 4.5, 'A revoir.', 'Biotechnologies', '2025-06-01', 7),
    (19.5, 18.5, 'Excellent.', 'SQL avancé', '2025-06-01', 8),
    (8.0, 10.5, 'Moyen.', 'Questionnement psychique', '2025-06-01', 9),
    (10.0, 12.5, 'Correct.', 'PHP avancé', '2025-06-01', 10);

    INSERT INTO Alerte (datLim1, datLim2) VALUES
    ('2025-01-15', '2025-06-15');
