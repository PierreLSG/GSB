<?php
//fichier qui permet de faire la verification sur les utilisateurs
include("include/verification.php");
?>
<!DOCTYPE html>
<html lang="en">
<!--Inclusion du head-->
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
                <a href="index.php" class="btn btn-default btnMenu shadow">Validation des fiches</a>
                <a href="suivisPaiement.php" class="btn btn-default btnMenu shadow">Suivis paiement fiches de frais</a>
                <a href="profile.php" class="btn btn-default btnMenu shadow">Profile</a>
                <a href="../include/deconnexion.php" class="btn btn-default btnMenu shadow">Deconnexion</a>
              </div>
              <br>
            </div>
        </div>
    </header>
    <?php
      //requete pour aller chercher les visiteurs dans la bdd
      $reqVisiteur = $bdd->prepare('SELECT id, nom, prenom FROM visiteur WHERE idFonction = :idFonction');
      $reqVisiteur->execute(array(
        ':idFonction'=> "2"));
    ?>
    <div class="container" id="containerMain">
    	<section class="container-fluid" id="forfait">
        <form id="mois" method="get" action="index.php">
          <div class="row">
            <div class="col-md-12">
            <br>
                <div class="col-md-2">
                    <label for="selectCat">Choisissez un visiteur:</label>
                </div>
                <div class="form-group col-md-6">
                    <select class="form-control shadow" name="id">
                        <?php
                          while($resVisiteur = $reqVisiteur->fetch()){
                            echo'
                            <option value='.$resVisiteur['id'].'>'.$resVisiteur['nom'].' '.$resVisiteur['prenom'].'</option>';
                          }
                        ?>
                    </select>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-2 col-md-offset-6">
                  <input type="submit" class="btn btn-success shadow" name="envoi" value="Valider"/>
                  <a href="index.php" class="btn btn-danger shadow">Annuler</a>
              </div>
          </div>
        </form> 
        <br>
      </section>

      <div class="row contentDate">
      </div>

      <section class="container-fluid" id="horsForfait">
      </section>
      <!--Inclusion de la page valideFiche.php-->
      <?php include('include/valideFiche.php') ?>
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
    <!--Inclusion du footer-->
    <?php include('../include/footer.php'); ?>
  </body>
</html>