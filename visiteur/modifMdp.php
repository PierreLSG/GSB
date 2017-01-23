<?php
//inclusion de la page vérification
include('include/verification.php');
?>
<!DOCTYPE html>
<html lang="fr">
<!--inclution du head-->
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
       	<br>
			<form id="modifProfile" method="post" action="../ttt/modifMdp.php">
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
						<label for="text">Nouveau mot de passe</label>
					    <br>
						<input type="password" class="form-control shadow" name="mdp">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
					    <br>
					    <label for="text">Confirmation</label>
					    <br>
						<input type="password" class="form-control shadow" name="confirmation">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-6">
					    <br>
							<button type="submit" class="btn btn-warning shadow" id="buttonvalid" name="modifier" value="modifier">Modifier</button>
              <a href="modifMdp.php" class="btn btn-danger shadow">Annuler</a>
					</div>
				</div>
			</form>
			<br>
       	</section>
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
    <!--inclution du footer-->
  	<?php include('../include/footer.php'); ?>
  </body>
</html>