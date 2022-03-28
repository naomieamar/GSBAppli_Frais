<?php

/* 
 * * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Naomie Amar
 */
?>
<h2>Suivre le Paiement </h2>
<div class="row">
    <div class="col-md-4">
        <h3>Sélectionner une fiche de frais  : </h3>
    </div>
    <div class="col-md-4">
        <form action="index.php?uc=suivrePaiement&action=suivreFicheValide" 
              method="post" role="form">
            <div class="form-group">
                <label for="lstFrais" accesskey="n">Liste fiche frais : </label>
                <select id="lstFrais" name="lstFrais" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($visiteur == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $visiteur ?>">
                                <?php echo $nom . ' / ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . '/' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
            <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
                   role="button">
        </form>
    </div>
</div>

