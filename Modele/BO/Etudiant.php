<?php

namespace BO;

class Etudiant extends Utilisateur {

    private bool $altUti;
    private ?Tuteur $monTuteur;
    private ?Classe $maClasse;
    private ?MaitreApprentissage $monMaiApp;
    private ?Specialite $maSpecialite;
    private ?Bilan1 $monBilan1;
    private ?Bilan2 $monBilan2;
    private ?Entreprise $monEntreprise;
    public function __construct(bool $altUti, ?Entreprise $monEntreprise, ?Tuteur $monTuteur, ?Classe $maClasse, ?MaitreApprentissage $monMaiApp, ?Specialite $maSpecialite, ?Bilan1 $mesBilan1, ?Bilan2 $mesBilan2,int $idUti, string $nomUti, string $preUti, string $mailUti, string $telUti, string $adrUti, string $cpUti, string $vilUti, string $logUti, string $mdpUti)
    {
        $this->altUti = $altUti;
        $this->monEntreprise = $monEntreprise;
        $this->monTuteur = $monTuteur;
        $this->maClasse = $maClasse;
        $this->monMaiApp = $monMaiApp;
        $this->maSpecialite = $maSpecialite;
        $this->monBilan1 = $mesBilan1;
        $this->monBilan2 = $mesBilan2;
        parent::__construct($idUti, $nomUti,  $preUti,  $mailUti,  $telUti,  $adrUti,  $cpUti,  $vilUti,  $logUti,  $mdpUti);
    }

    public function isAltUti(): bool
    {
        return $this->altUti;
    }

    public function setAltUti(bool $altUti): void
    {
        $this->altUti = $altUti;
    }

    public function getMonTuteur(): ?Tuteur
    {
        return $this->monTuteur;
    }

    public function setMonTuteur(Tuteur $monTuteur): void
    {
        $this->monTuteur = $monTuteur;
    }

    public function getMaClasse(): Classe
    {
        return $this->maClasse;
    }

    public function setMaClasse(Classe $maClasse): void
    {
        $this->maClasse = $maClasse;
    }

    public function getMonMaiApp(): MaitreApprentissage
    {
        return $this->monMaiApp;
    }

    public function setMonMaiApp(MaitreApprentissage $monMaiApp): void
    {
        $this->monMaiApp = $monMaiApp;
    }

    public function getMaSpecialite(): Specialite
    {
        return $this->maSpecialite;
    }

    public function setMaSpecialite(Specialite $maSpecialite): void
    {
        $this->maSpecialite = $maSpecialite;
    }

    public function getMonBilan1(): ?Bilan1
    {
        return $this->monBilan1;
    }

    public function setMonBilan1(?Bilan1 $mesBilan1): void
    {
        $this->monBilan1 = $mesBilan1;
    }

    public function getMonBilan2(): ?Bilan2
    {
        return $this->monBilan2;
    }

    public function setMonBilan2(?Bilan2 $mesBilan2): void
    {
        $this->monBilan2 = $mesBilan2;
    }

    public function isAltEtu(): bool {
        return $this->altUti;
    }

    public function getIdSpecialite(): int {
        return $this->maSpecialite->getIdSpe();
    }

    public function getIdClasse(): int {
        return $this->maClasse->getIdCla();
    }

    public function getIdMaiApp(): int {
        return $this->monMaiApp->getIdMai();
    }

    public function getIdTuteur(): int {
        return $this->monTuteur->getIdUti();
    }

    public function getIdEtu(): int {
        return $this->idUti;
    }

    public function getMonEntreprise(): ?Entreprise
    {
        return $this->monEntreprise;
    }

    public function setMonEntreprise(?Entreprise $monEntreprise): void
    {
        $this->monEntreprise = $monEntreprise;
    }




}