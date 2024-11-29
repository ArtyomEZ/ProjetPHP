CREATE TABLE Specialite (
    idSpe INT NOT NULL AUTO_INCREMENT,
    nomSpe VARCHAR(50),
    CONSTRAINT Specialite_PK PRIMARY KEY (idSpe)
)ENGINE=InnoDB;

CREATE TABLE Type_Utilisateur (
    idTypUser INT NOT NULL AUTO_INCREMENT,
    typUser VARCHAR(35),
    CONSTRAINT Type_Utilisateur_PK PRIMARY KEY (idTypUser)
)ENGINE=InnoDB;

CREATE TABLE Entreprise (
    idEnt INT NOT NULL AUTO_INCREMENT,
    nomEnt VARCHAR(75),
    adrEnt VARCHAR(100),
    cpEnt VARCHAR(10),
    vilEnt VARCHAR(50),
    CONSTRAINT Entreprise_PK PRIMARY KEY (idEnt)
)ENGINE=InnoDB;

CREATE TABLE Classe (
    idCla INT NOT NULL AUTO_INCREMENT,
    nomCla VARCHAR(75),
    maxEtuCla INT,
    CONSTRAINT Classe_PK PRIMARY KEY (idCla)
)ENGINE=InnoDB;

CREATE TABLE Maitre_Apprentissage (
    idMai INT NOT NULL AUTO_INCREMENT,
    nomMai VARCHAR(100),
    preMai VARCHAR(100),
    telMai VARCHAR(20),
    mailMai VARCHAR(100),
    idEnt INT,
    CONSTRAINT Maitre_Apprentissage_PK PRIMARY KEY (idMai),
    CONSTRAINT Maitre_Apprentissage_Entreprise_FK FOREIGN KEY (idEnt) REFERENCES Entreprise(idEnt)
)ENGINE=InnoDB;

CREATE TABLE Utilisateur (
    idUti INT NOT NULL AUTO_INCREMENT,
    nomUti VARCHAR(50),
    preUti VARCHAR(50),
    mailUti VARCHAR(75),
    telUti VARCHAR(15),
    adrUti VARCHAR(100),
    cpUti VARCHAR(10),
    vilUti VARCHAR(50),
    logUti VARCHAR(50),
    mdpUti VARCHAR(50),
    altUti BOOLEAN,
    nbrMaxEtu3 INT,
    nbrMaxEtu4 INT,
    nbrMaxEtu5 INT,
    idTypUser INT,
    idSpe INT,
    idCla INT,
    idEnt INT,
    idMai INT,
    idTut INT NULL,
    CONSTRAINT Utilisateur_PK PRIMARY KEY (idUti),
    CONSTRAINT Utilisateur_TypeUtilisateur_FK FOREIGN KEY (idTypUser) REFERENCES Type_Utilisateur(idTypUser),
    CONSTRAINT Utilisateur_Specialite_FK FOREIGN KEY (idSpe) REFERENCES Specialite(idSpe),
    CONSTRAINT Utilisateur_Classe_FK FOREIGN KEY (idCla) REFERENCES Classe(idCla),
    CONSTRAINT Utilisateur_Entreprise_FK FOREIGN KEY (idEnt) REFERENCES Entreprise(idEnt),
    CONSTRAINT Utilisateur_MaitreApprentissage_FK FOREIGN KEY (idMai) REFERENCES Maitre_Apprentissage(idMai),
    CONSTRAINT Utilisateur_Utilisateur_FK FOREIGN KEY (idTut) REFERENCES Utilisateur(IdUti)
)ENGINE=InnoDB;

CREATE TABLE Bilan1 (
    idBil1 INT NOT NULL AUTO_INCREMENT,
    notEnt1 DECIMAL(5, 2),
    notDos1 DECIMAL(5, 2),
    notOral1 DECIMAL(5, 2),
    rema1 VARCHAR(255),
    datBil1 DATE,
    idUti INT,
    CONSTRAINT Bilan1_PK PRIMARY KEY (idBil1),
    CONSTRAINT Bilan1_Utilisateur_FK FOREIGN KEY (idUti) REFERENCES Utilisateur(idUti)
)ENGINE=InnoDB;

CREATE TABLE Bilan2 (
    idBil2 INT NOT NULL AUTO_INCREMENT,
    notDos2 DECIMAL(5, 2),
    notOral2 DECIMAL(5, 2),
    rema2 VARCHAR(255),
    sujMem VARCHAR(100),
    datBil2 DATE,
    idUti INT,
    CONSTRAINT Bilan2_PK PRIMARY KEY (idBil2),
    CONSTRAINT Bilan2_Utilisateur_FK FOREIGN KEY (idUti) REFERENCES Utilisateur(idUti)
)ENGINE=InnoDB;

CREATE TABLE Alerte (
    idAlerte INT NOT NULL AUTO_INCREMENT,
    datLim1 DATE,
    datLim2 DATE,
    CONSTRAINT Alerte_PK PRIMARY KEY (idAlerte)
)ENGINE=InnoDB;
