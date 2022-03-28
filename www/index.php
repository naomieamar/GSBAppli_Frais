<?php
/**
 * Index du projet GSB
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author    Naomie Amar
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdogsb.inc.php';
//avant d'ouvrir index il faut que ces fichiers s'ouvrent 

session_start();
//une fonction qui demarre la superglobal session 
//variable qui est commune a tout le programme on peut l'appeller dans les differentes pages

$pdo = PdoGsb::getPdoGsb();// une variable pdo prends le resultat de la methode getpdogsb qui est dans pdogsb
// en php une variable est precede du signe $

$estConnecte = estConnecte();
require 'vues/v_entete.php';
// a besoin de ce dossier mais peut se poursuivre sans 

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
//uc : variable super global qui nous renseigne le controleur

if ($uc && !$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) {
case 'connexion':
    include 'controleurs/c_connexion.php';
    //include =aller vers 
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
case 'suivrePaiement':
    include 'controleurs/c_suivrePaiement.php';
    break;
}
require 'vues/v_pied.php';
