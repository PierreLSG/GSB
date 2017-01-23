<?php
if($_POST["frais"] == "forfait"){ 
    //Déclaration des variables
    $idLigneFraisForfait = strip_tags($_POST['id']);
    //requete pour allerc hercher les lignes de frais au forfait
    $req = $bdd->prepare('SELECT * FROM LigneFraisForfait WHERE id = :idLigneFraisForfait');
    $req->execute(array(
        ':idLigneFraisForfait'=>$idLigneFraisForfait));
    $res = $req->fetch();
    //Mise au bon format de la date
    $mois = date('d-m-y', strtotime($res["mois"]));
    //mise en forme des variabeles
    $idFraisforfais = $res['idFraisForfait'];
    //requete pour aller chercher les frais
    $reqlibelle = $bdd->prepare('SELECT id, libelle FROM fraisforfait WHERE id = :idFraisforfais');
    $reqlibelle->execute(array(
        ':idFraisforfais'=>$idFraisforfais));
    $reslibelle = $reqlibelle->fetch();
    ?>
    			<!--Début du formulaire Au forfait--> 
    <form id="formFraisForfait" method="post" action="../ttt/modiffrais.php">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="titre">Frais au forfait :</h1>
                <br>
            </div>
            <div class="col-md-12">
                <div class="col-md-2">
                    <label for="selectCat">Choisissez un forfait:</label>
                </div>
                <div class="form-group col-md-6">
                    <?php
                    echo '<select class="form-control shadow" id="selectForfait" name="selectForfait">
                          <option value = '.$reslibelle['id'].'>'.$reslibelle['libelle'].'</option>';
                        //recherche dans la bdd des libéllé
                        $reqlib = $bdd->prepare('SELECT id,libelle FROM fraisforfait WHERE id <> :id');
                        $reqlib->execute(array(
                            ':id'=>$reslibelle['id']));
                        while($reslib = $reqlib->fetch()){
                            echo '<option value = '.$reslib['id'].'>'.$reslib['libelle'].'</option>';
                         }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    	<div class="row">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label for="inputFrais">Saisissez la Quantité:</label>
                </div>
                <div class="form-group col-md-6">
                    <?php
                      echo '<input type="number" class="form-control shadow" id="quantite" name="quantite" min="0" value='.$res['quantite'].'>';
                    ?>
                </div>
            </div>
   		</div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label for="datepicker">Saisissez la date :</label>
                </div>
                <div class="form-group col-md-6 sandbox-container">
                    <div class="input-group date">
                    <?php
                      echo '<input type="text" class="form-control shadow" id="date" name="date" value='.$mois.'><span class="input-group-addon shadow"><i class="glyphicon glyphicon-th"></i></span>';
                      ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4 col-md-offset-6">
            <?php echo "<input type='hidden' name='idLigneFraisForfait' value=".$idLigneFraisForfait.">"; ?>
            	<input type="submit" class="btn btn-success shadow" name="envoi" value="Modiffier"/>
                <a href="index.php" class="btn btn-danger shadow">Annuler</a>
            </div>
        </div>
    			<!--FIN du formulaire Au forfait--> 
    </form>
    <br>
</section>

<?php

}