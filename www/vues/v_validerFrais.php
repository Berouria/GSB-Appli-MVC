<?php
/**
 * Vue Valider les frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<form action="index.php?uc=validerFrais&action=modifierFraisForfait" 
      method="post" role="form">
    <div class="row">
        <h2>Mes fiches de frais</h2>
        <div class="col-md-4">
            <h3>Sélectionner un visiteur : </h3>
            <div class="form-group">
                <label for="lstVisiteur" accesskey="n"> </label>
                <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                    <?php
                    foreach ($visiteur as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Sélectionner un mois : </h3>

            <div class="form-group">
                <label for="lstMois" accesskey="n"> </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
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
    <div class="row">    
        <h2 style="color: orangered">Valider la fiche de frais</h2>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                
                
                ?>
                <button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
            </fieldset>
        </div>
    </div>

</form>
<br> <div class="row">

    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
                <?php
                foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                    $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                    $date = $unFraisHorsForfait['date'];
                    $montant = $unFraisHorsForfait['montant'];
                    $idFrais = $unFraisHorsForfait['id'];
                    ?>           
                    <tr>

                <form action="index.php?uc=validerFrais&action=corrigerFraisHorsForfait" 
                      method="post" role="form">
                    <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $moisASelectionner ?>">
                    <input name="lstVisiteur" type="hidden" id="lstVisiteur" class="form-control" value="<?php echo $visiteurASelectionner ?>">
                    <td><input type="hidden" id="idFrais" 
                               name="idFrais"
                               size="10" maxlength="5" 
                               value="<?php echo $idFrais ?>" 
                               class="form-control">
                        <input type="text" id="idFrais" 
                               name="date"
                               size="10" maxlength="10" 
                               value="<?php echo $date ?>" 
                               class="form-control"></td>
                    <td><input type="text" id="idFrais" 
                               name="libelle"
                               size="10" maxlength="30" 
                               value="<?php echo $libelle ?>" 
                               class="form-control"></td> 
                    <td><input type="text" id="idFrais" 
                               name="montant"
                               size="10" maxlength="5" 
                               value="<?php echo $montant ?>" 
                               class="form-control"></td>
                    <td> 
                        <input id="corrigerFHF" name="corrigerFHF" type="submit" value="Corriger" class="btn btn-success"/>
                        <input id="supprimerFHF" name="supprimerFHF" type="submit" value="Supprimer" class="btn btn-danger"/>
                        <input id="reporterFHF" style="background-color: orange" name="reporterFHF" type="submit" value="Reporter" class="btn btn-success"/>
                    </td>
                </form>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>  
<form action="index.php?uc=validerFrais&action=validerFicheFrais" 
      method="post" role="form">
    <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $moisASelectionner ?>">
    <input name="lstVisiteur" type="hidden" id="lstVisiteur" class="form-control" value="<?php echo $visiteurASelectionner ?>">
    <div class ="row">
        <label for="idFrais">Nombre de justificatifs </label>
        <input  id="idFrais" 
                name="libelle"
                size="10" maxlength="30" 
                value="<?php echo $nbJustificatifs ?>" 
                class="form-control"><br>
        <button class="btn btn-success" type="submit">Valider</button>
        <button class="btn btn-danger" type="reset">Réinitialiser</button>
    </div>
</form>