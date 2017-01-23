<?php
//inclusion de la page vérification
include('include/verification.php');
//inclusion de la page fichefrais
include('../ttt/ficheFrais.php');
?>
<!DOCTYPE html>
<html lang="en">
<!--inclusion de la page head-->
<?php include('../include/head.php') ?>
  <body>
  	<header class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <br>
                <a href="index.php"><img class="img-responsive" src="../image/logo.png" alt="LogoLaboratoireGSB"></a>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title"> Application Gestion de Frais </h1>
            </div>
            <div class="col-md-8 col-md-offset-0">
                <div class="btn-group btn-group-justified">
                  <a href="index.php" class="btn btn-default btnMenu shadow">Saisie de Frais</a>
                  <a href="consultfiche.php" class="btn btn-default btnMenu shadow">Consultation des fiches</a>
                  <a href="profile.php" class="btn btn-default btnMenu shadow">Profile</a>
                  <a href="../include/deconnexion.php" class="btn btn-default btnMenu shadow">Deconnexion</a>
                </div>
                <br>
            </div>
        </div>
    </header>
    <div class="container" id="containerMain">
    	<section class="container-fluid" id="forfait">
        									<!--Début du formulaire Au forfait-->
            <form id="formFraisForfait" method="post" action="../ttt/frais.php">
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
                            <select class="form-control shadow" id="selectForfait" name="selectForfait">
                                <!--recherche dans la bdd des libéllé-->
                                <?php
                                $req = $bdd->query('SELECT id, libelle FROM fraisforfait');
                                while($res = $req->fetch()){
                                    echo '<option value = '.$res['id'].'>'.$res['libelle'].'</option>';
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
                              <input type="number" class="form-control shadow" id="quantite" name="quantite" min="0">
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
                               <input type="text" class="form-control shadow" id="date" name="date" ><span class="input-group-addon shadow"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-6">
                        <input type="submit" class="btn btn-success shadow" name="envoi" value="Valider"/>
                        <a href="index.php" class="btn btn-danger shadow">Annuler</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-7">
                    </div>
                </div>
                        <!--FIN du formulaire Au forfait--> 
            </form>
            <br> 
            <?php include('include/fraisforfait.php') ?>
        </section>
        <?php
        include('../ttt/date.php');

        //Requete pour aller chercher le commentaire dans la BDD pour l'afficher
        $reqCommentaire = $bdd->prepare('SELECT commentaire FROM commentaire WHERE idVisiteur = :idVisiteur AND idFicheFrais = :idFicheFrais');
        $reqCommentaire->execute(array(
            'idVisiteur'=>$idVisiteur,
            ':idFicheFrais'=>$idFichefrais));
        $resCommentaire = $reqCommentaire->fetch();
        //Formatage de la variable
        $commentaire = $resCommentaire['commentaire'];

        ?>
        <div class="row contentDate">
        	<div class="col-md-12 text-center DateStyle">
                <h4> 
                    Fiche de frais correspondant :
                    <?php echo '<span class="mois">'.$mois.'</span>' ?>
                    <?php echo '<span class="anne">'.$anne.'</span>' ?>
                </h4>
            	
                <form id="commentaire" method="post" action="../ttt/commentaire.php">
                    <div class="form-group">
                        <label for="comment">Commentaire:</label>
                        <textarea class="form-control" rows="5" id="commentaire" name="commentaire"><?php echo $commentaire?></textarea>
                        <?php echo "<input type='hidden' name='idFicheFrais' id='idFicheFrais' value=".$idFichefrais.">" ?>
                        <br>
                        <input type="submit" class="btn btn-success shadow" name="envoi" value="Valider"/>
                        <a href="index.php" class="btn btn-danger shadow">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
        <section class="container-fluid" id="horsForfait">
        									<!--Début du formulaire Hors forfait--> 
        <form id="formFraisHF" method="post" action="../ttt/fraisHF.php" enctype="multipart/form-data"> 
        	<div class="row">
            	<div class="col-md-12 text-center">
                    <h1 class="titre">Frais hors forfait :</h1>
                    <br>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-2" id="grpBtnHF">
                	<label for="inputDate">Date :</label>
            		<div class="input-group inpHF">
                    	<div class="form-group col-md-12 sandbox-container">
                        	<div class="input-group date">
                            	<input type="text" class="form-control shadow" id="date" name="date" ><span class="input-group-addon shadow"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                	<label for="inputLibelle">Libelle :</label>
                    <div class="input-group inpHF">
                    	<input type="text" class="form-control shadow" id="libelle" name="libelle">
                    </div>
                </div>
                <div class="col-md-2">
                	<label for="inputMotant inpHF">Montant :</label>
                    <div class="input-group">
                    	<input type="number" class="form-control shadow" id="montant" name="montant" min="0" step="any">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="inputMotant inpHF">Justificatifs :</label>
                    <div class="input-group">
                        <input type="file" class="input-xlarge" id="fileselect" accept="*" name="fileselect" />
                    </div>
                </div>
                <div class="col-md-2 pull-right">
                <br>
                	<input type="submit" class="btn btn-success shadow" name="envoi" value="Valider"/>
                    <a href="index.php" class="btn btn-danger shadow">Annuler</a>
                </div>
            </div>
        							<!--FIN du formulaire Hors forfait--> 
        </form>
        <br>
           <?php include('include/fraishorsforfait.php') ?>
        </section>
        <?php $totaux = $totauxFF + $totauxFHF ?>
        <div class="row contentDate">
            <div class="col-md-12 text-center DateStyle">
                <h4> Total des frais de la fiche: <?php echo $totaux ?> €</h4>
            </div>
        </div>
    </div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="../js/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript">
	$('.sandbox-container .input-group.date').datepicker({
    });
	</script>
    <!--inclusion de la page footer-->
    <?php include('../include/footer.php'); ?>
  </body>
</html>