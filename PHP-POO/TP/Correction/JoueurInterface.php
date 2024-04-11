<?php
namespace TP\Correction;
interface JoueurInterface
{
 public function getNom() : string;
 public function getPrenom() : string;
 public function getClassement() : int;
 public function setNom(string $nouveauNom) : void;
 public function setPrenom(string $nouveauPrenom) : void;
}