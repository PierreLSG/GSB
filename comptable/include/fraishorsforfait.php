<?php
//Condition pour savoir le frais est hors forfait
if($_POST["frais"] == "horsforfait"){
    //mise en forme des variables
    $idVisiteur = strip_tags($_POST['idVisiteur']);
    $idLigneFraisHorsForfait = strip_tags($_POST['id']);
    //Requete pour aller chercher la bonne ligne de frais hors forfait
    $req = $bdd->prepare('SELECT * FROM LigneFraisHorsForfait WHERE id = :idLigneFraisHorsForfait');
    $req->execute(array(
        ':idLigneFraisHorsForfait'=>$idLigneFraisHorsForfait));
    $res = $req->fetch();
    //mise en forme de la date
    $mois = date('d-m-y', strtotime($res["date"]));

    ?>

    <form id="formFraisHF" method="post" action="../ttt/modiffraisHF.php" enctype="multipart/form-data"> 
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Frais hors forfait :</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="grpBtnHF">Veuillez compléter les champs suivant :</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" id="grpBtnHF">
                <label for="inputDate">Date :</label>
                <div class="input-group inpHF">
                    <div class="form-group col-md-12 sandbox-container">
                        <div class="input-group date">
                            <?php
                              echo '<input type="text" class="form-control shadow" id="date" name="date" value='.$mois.'><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>';
                              ?>
                        </div>
                        </div>
                </div>
            </div>
            <div class="col-md-3">
                <label for="inputLibelle">Libelle :</label>
                <div class="input-group inpHF">
                    <?php
                        echo '<input type="text" class="form-control shadow" id="libelle" name="libelle" value='.$res['libelle'].'>';
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <label for="inputMotant inpHF">Montant :</label>
                <div class="input-group">
                    <?php
                      echo '<input type="number" class="form-control shadow" id="montant" name="montant" step="any" value='.$res['montant'].'>';
                    ?>
                </div>
            </div>
            <div class="col-md-3">
            <label for="inputMotant inpHF">Justificatifs :</label>
            <div class="input-group">
                <input type="file" class="input-xlarge" id="fileselect" accept="*" name="fileselect" />
            </div>
        </div>
            <div class="col-md-4 col-md-offset-8">
            <br>   
            <?php 
                //Bouton cacher pour passer des variables dans la page de traitement.
                echo "<input type='hidden' name='idLigneFraisHorsForfait' value=".$idLigneFraisHorsForfait.">
                      <input type='hidden' name='idVisiteur' value=".$idVisiteur.">"; ?>
                <input type="submit" class="btn btn-success shadow" name="envoi" value="Modiffier"/>
                <a href="SaisieFrais.php" class="btn btn-danger shadow">Annuler</a>
            </div>
        </div>
                                <!--FIN du formulaire Hors forfait--> 
        <br>
    </form>
<?php } ?>