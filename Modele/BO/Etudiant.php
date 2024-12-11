<?php

namespace BO;

class Etudiant extends Utilisateur {

    private bool $altUti;
    private Tuteur $monTuteur;
    private Classe $maClasse;
    private MaitreApprentissage $monMaiApp;
    private Specialite $maSpecialite;
    private array $mesBilan1;
    private array $mesBilan2;

    public function __construct(bool $altUti, Tuteur $monTuteur, Classe $maClasse, MaitreApprentissage $monMaiApp, Specialite $maSpecialite, array $mesBilan1, array $mesBilan2,int $idUti, string $nomUti, string $preUti, string $mailUti, string $telUti, string $adrUti, string $cpUti, string $vilUti, string $logUti, string $mdpUti)
    {
        $this->altUti = $altUti;
        $this->monTuteur = $monTuteur;
        $this->maClasse = $maClasse;
        $this->monMaiApp = $monMaiApp;
        $this->maSpecialite = $maSpecialite;
        $this->mesBilan1 = $mesBilan1;
        $this->mesBilan2 = $mesBilan2;
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

    public function getMonTuteur(): Tuteur
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

    public function getMesBilan1(): array
    {
        return $this->mesBilan1;
    }

    public function setMesBilan1(array $mesBilan1): void
    {
        $this->mesBilan1 = $mesBilan1;
    }

    public function getMesBilan2(): array
    {
        return $this->mesBilan2;
    }

    public function setMesBilan2(array $mesBilan2): void
    {
        $this->mesBilan2 = $mesBilan2;
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



}