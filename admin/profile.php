<?php
include('include/verification.php');
//requette pour aller chercher dans la bdd les info consernant la personne
$req = $bdd->prepare('SELECT * FROM visiteur WHERE id = :id');
$req->execute(array(
	':id'=>$_SESSION["id"]));
$res = $req->fetch();
//Declaration des variable
$nom = $res['nom'];
$prenom = $res['prenom'];
$login = $res['login'];
$adresse = $res['adresse'];
$cp = $res['cp'];
$ville = $res['ville'];
//mise ne forme de la date
$dateEmbauche = date('d-m-Y', strtotime($res['dateEmbauche']));
?>
<!DOCTYPE html>
<html lang="fr">
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
	                  <?php if($_SESSION['fonction'] == "1"){ echo '<a href="index.php" class="btn btn-default btnMenu shadow">Admin</a>';}?>
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
			<div class="row">
				<div class="col-md-3 col-md-offset-1">
					<a href="modifMdp.php"><button type="button" class="btn btn-warning shadow" id="buttonvalid" name="modifier" value="modifier mot de passe">Modifier mot de passe</button></a>
				</div>
			</div>
			<form id="modifProfile" method="post" action="../ttt/modifProfile.php">
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
						<label for="text">Nom</label>
					    <br>
						<?php echo '<input type="text" class="form-control shadow" name="nom" value='.$nom.'>' ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
					    <br>
					    <label for="text">Prenom</label>
					    <br>
							<?php echo '<input type="text" class="form-control shadow" name="prenom" value='.$prenom.'>' ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
					    <br>
					    <label for="text">Login</label>
					    <br>
							<?php echo '<input type="text" class="form-control shadow" name="login" value='.$login.'>' ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
					    <br>
					    <label for="text">Adresse</label>
					    <br>
							<?php echo '<input type="text" class="form-control shadow" name="adresse" value="', htmlspecialchars($adresse, ENT_QUOTES, 'UTF-8'), '">' ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
					    <br>
					    <label for="text">Code Postal</label>
					    <br>
							<?php echo '<input type="text" class="form-control shadow" name="cp" value='.$cp.'>' ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
					    <br>
					    <label for="text">Ville</label>
					    <br>
							<?php echo '<input type="text" class="form-control shadow" name="ville" value="', htmlspecialchars($ville, ENT_QUOTES, 'UTF-8'), '">' ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-5">
					    <br>
					    <label for="datepicker">Date d'embauche</label>
					    <br>
						    <div class="sandbox-container">
								<div class="input-group date">
		                            <?php echo '<input type="text" class="form-control shadow" id="date" name="date"  value='.$dateEmbauche.'><span class="input-group-addon shadow"><i class="glyphicon glyphicon-th"></i></span>' ?>
		                        </div>
		                    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-6">
					    <br>
							<button type="submit" class="btn btn-warning shadow" id="buttonvalid" name="modifier" value="modifier">Modifier</button>
							<a href="profile.php" class="btn btn-danger shadow">Annuler</a>
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
	<!--Inclusion du footer-->
  	<?php include('../include/footer.php'); ?>
  </body>
</html>