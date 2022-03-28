<?php
/**
 * Vue Mise en paiement de la fiche
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Tsipora Schvarcz
 */
?>
<form method="post" 
              action="index.php?uc=suivrePaiement&action=paiement" 
              role="form">
    <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $leMois ?>">
    <input name="lstVisiteurs" type="hidden" id="lstVisiteurs" class="form-control" value="<?php echo $idVisiteur ?>">
    <input id="ok" type="submit" value="Mise en paiement" class="btn btn-success" 
            role="button">
</form>





