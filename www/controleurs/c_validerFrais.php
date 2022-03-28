<?php
/**
 * Gestion de l'accueil
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Naomie Amar
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idComptable = $_SESSION['idUtilisateur'];
$moisActuel = getMois(date('d/m/Y'));
$moisPrecedent = getMoisPrecedent($moisActuel);
$fichesCL = $pdo->ficheDuDernierMoisCL($moisPrecedent);
if (!$uc) {
    $uc = 'validerFrais';
}

// filter input ça permet de recupere ce que l'utilisateur a remplit 
switch ($action){
case 'choisirVisiteurEtMois':
    $lesVisiteurs = $pdo->getLesVisiteurs();
    $lesCles[]= array_keys($lesVisiteurs);
    $visiteurASelectionner = $lesCles[0];
   // $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
   $lesMois = getLesDouzeDerniersMois($moisActuel);
    $lesCles[] = array_keys($lesMois);
    $moisASelectionner = $lesCles[0];
    //met le en position 0
     include 'vues/v_listeVisiteurs.php';
    break;

case 'voirEtatFrais':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $lesVisiteurs=$pdo->getLesVisiteurs();
        $visiteurASelectionner=$idVisiteur;
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $lesMois = getLesDouzeDerniersMois($moisActuel);
        $moisASelectionner=$mois;
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        
        $_SESSION ['idV']=$idVisiteur;
        $_SESSION['idM']=$mois;
        
        if(!is_array($lesInfosFicheFrais)){
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_listeMois.php';
        }
        else{
            include 'vues/v_validerFrais.php';
        }
        break;
        
case 'validerMajFraisForfait':
    $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    $mois =$_SESSION['idM'];
    $idVisiteur= $_SESSION['idV'];
    $lesVisiteurs=$pdo->getLesVisiteurs();
    $visiteurASelectionner=$idVisiteur;
    $lesMois = getLesDouzeDerniersMois($moisActuel);
    $moisASelectionner=$mois;

    if (lesQteFraisValides($lesFrais)) {
        
        $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
        include 'vues/v_validerFrais.php';
    } else {
        ajouterErreur('Les valeurs des frais doivent être numériques');
        include 'vues/v_erreurs.php';
    }
break;

case 'validerMajFraisHorsForfait':
    $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
    var_dump($idFrais);
    $pdo->supprimerFraisHorsForfait($idFrais);
    include 'vues/v_modifierFraisHorsForfait.php';
    
break;
    
case 'actualiserNouvelElement':
        
    $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
    $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
    $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
    $mois =$_SESSION['idM'];
    $idVisiteur= $_SESSION['idV'];
    //var_dump($montant);//var_dump= afficher les informations d'une variable.
    valideInfosFrais($dateFrais, $libelle, $montant);
    if (nbErreurs() != 0) {
        include 'vues/v_erreurs.php';
    } else {
        $pdo->creeNouveauFraisHorsForfait(
            $idVisiteur,
            $mois,
            $libelle,
            $dateFrais,
            $montant
        );
        $lesVisiteurs=$pdo->getLesVisiteurs();
        $visiteurASelectionner=$idVisiteur;
        $lesMois = getLesDouzeDerniersMois($moisActuel);
        $moisASelectionner=$mois;
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
      
    include 'vues/v_validerFrais.php';    
    }
break;
case 'supprimerFraisHorsForfait':
    $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
    $pdo->supprimerFraisHorsForfait($idFrais);
    
    $mois =$_SESSION['idM'];
    $idVisiteur= $_SESSION['idV'];
    $lesVisiteurs=$pdo->getLesVisiteurs();
        $visiteurASelectionner=$idVisiteur;
        $lesMois = getLesDouzeDerniersMois($moisActuel);
        $moisASelectionner=$mois;
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);

        include 'vues/v_validerFrais.php'; 
break;

case 'validerFicheFrais':
    $idVisiteur= $_SESSION['idV'];
    $mois =$_SESSION['idM'];
    $pdo->majEtatFicheFrais($idVisiteur, $mois, 'VA');
    include 'vues/v_accueilComptable.php'; 
    break; 
}
