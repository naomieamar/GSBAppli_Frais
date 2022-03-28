<?php

/*  Gestion de l'accueil
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Naomie Amar 
  
 */
?>
<form method="post" 
              action="index.php?uc=validerFrais&action=voirEtatFrais" 
              role="form">
   
<div class="row">    
    <div class="col-md-4">
        
            <div class="form-group">
                <label for="lstVisiteurs" accesskey="n">Choisir un visiteur : </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . '  ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . '  ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
        
    </div>   

   <div class="col-md-4">
        
            <div class="form-group">
                <label for="lstMois" accesskey="n">Choisir un mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    //$LesMois=array() ;
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
     </div> 
    </div>
       <button class="btn btn-success" type="submit">Valider</button>
</form>

<form method="post" 
              action="index.php?uc=validerFrais&action=validerMajFraisForfait" 
              role="form">
   <h2  >Valider la fiche de frais</h2>
   <div class="row">    
    <h3>&nbsp;&nbsp;Eléments forfaitisés</h3>
    <div class="col-md-4">
        
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais //lesFrais est un tableau grace au foreach?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <a href= action="index.php?uc=validerFrais&action=validerMajFraisForfait">
                <button class="btn btn-success" type="submit">Corriger</button>
                </a>
                <!--submit pour envoyer --> 
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
                <!--reset pour effacer reinitialiser --> 
            </fieldset>
        
    </div>
   </div>
   
</form>

   <hr>
<div class="row">
    <div class="panel panel-info"style=color:black">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th> 
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                    <th class="action">&nbsp;</th> 
                </tr>
                <!--tr et th pour un tableau tr c'est les lignes et th c'est les colones -->
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <?php echo $date ?></td>
                    <td> <?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <!-- td c'est les colones avec les valeurs -->
                 
                    <td><a href="index.php?uc=validerFrais&action=validerMajFraisHorsForfait&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment corriger ce frais?');">
                            <Button class="btn btn-success" type="submit">Corriger</Button></a>
                    </td>
                           
                    <td><a href="index.php?uc=validerFrais&action=supprimerFraisHorsForfait&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">
                            <Button class="btn btn-success" type="submit">Supprimer</Button></a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
   
</div>
  
<a href="index.php?uc=validerFrais&action=validerFicheFrais&idFrais=<?php echo $id ?>" >
    <Button class="btn btn-success" type="submit">Valider cette fiche de frais </Button></a>