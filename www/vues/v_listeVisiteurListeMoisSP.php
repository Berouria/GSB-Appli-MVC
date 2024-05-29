<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<form action="index.php?uc=suivrePaiement&action=suivrePaiement" 
      method="post" role="form">
    <div class="row">

        <h2>Mes fiches de frais</h2>

        <div class="col-md-4">
            <h3>Sélectionner un visiteur : </h3>


            <div class="form-group">
                <label for="lstVsiteur" accesskey="n"> </label>
                <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                    <?php
                    foreach ($visiteur as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($idVisiteur == $visiteurASelectionner) {
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
                        $numAnnee = substr($mois, 0, 4);
                        $numMois = substr($mois, 4, 2);
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
    <input id="ok" type="submit" value="Valider" class="btn btn-success" 
           role="button"> 
    <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
           role="button">

</form>