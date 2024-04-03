<?php

class CompteBancaire
{
    private float $solde;
    private string $devise;
    private string $titulaire;

    public function __construct($titulaire, $soldeInitial, $devise)
    {
        $this->solde = $soldeInitial;
        $this->titulaire = $titulaire;
        $this->devise = $devise;
    }
    public function __destruct()
    {
    }
    public function setTitulaire($nouveauTitulaire, $nouveauSolde, $nouveauDevise): void
    {
        $this->titulaire = $nouveauTitulaire;
        $this->solde = (float)$nouveauSolde;
        $this->devise = $nouveauDevise;
//        echo GREEN . "Le titulaire du compte a été mis à jour avec succès." . RESET . PHP_EOL;
    }

    public function deposer($montant): float
    {
        if ($montant > 0) {
            $montantDepose = $this->solde += $montant;
            echo GREEN . "Dépôt de $montant {$this->devise} effectué avec succès." . RESET . PHP_EOL;
        } else {
            echo YELLOW . "Le montant du dépôt doit être supérieur à zéro." . RESET . PHP_EOL;
        }
        return $montantDepose;
    }

    public function retirer($montant): bool
    {
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            echo GREEN . "Retrait de $montant {$this->devise} effectué avec succès." . RESET . PHP_EOL;
            return true;
        } else {
            return false;
            echo YELLOW . "Le montant du retrait est insuffisant !" . RESET . PHP_EOL;
        }
    }

    public function afficherSolde(): void
    {
        echo GREEN . "Le solde du compte de {$this->titulaire} est de {$this->solde} {$this->devise}." . RESET . PHP_EOL;
    }
}






