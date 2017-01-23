<?php
include('include/verification.php')
?>
<!DOCTYPE html>
<html lang="en">
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
	                  <?php if($_SESSION['fonction'] == "1"){ echo '<a href="index.php" class="btn btn-default btnMenu shadow">Admin</a>';}?>
	                  <a href="profile.php" class="btn btn-default btnMenu shadow">Profile</a>
	                  <a href="../include/deconnexion.php" class="btn btn-default btnMenu shadow">Deconnexion</a>
	                </div>
	                <br>
	            </div>
	        </div>
	    </header>
	  	<?php
	  	//Requete pour aller chercher les info du visiteur ou comptable
	  	$reqInfo = $bdd->prepare('SELECT login, idFonction FROM visiteur WHERE id = :id');
	  	$reqInfo->execute(array(
	  		':id'=> $_GET["id"]));
	  	$resInfo = $reqInfo->fetch();
	  	?>
	    <div class="container" id="containerMain">
	    	<section class="container-fluid" id="forfait">
	        									<!--Début du formulaire Au forfait--> 
	        	<br>
	        	<div class="row">
		        	<div class="col-md-2 col-md-offset-1">
		        		<a href="index.php" class="btn btn-info shadow">Retour</a>
		        	</div>
		        </div>
	        	<form id="ajoutUtili" method="post" action="../ttt/modifUser.php">
					<div class="row">
						<div class="col-md-2 col-md-offset-3">
							<label for="text">Login</label>
						    <br>
							<?php echo '<input type="text" class="form-control shadow" name="login" value='.$resInfo['login'].'>' ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-md-offset-3">
						    <br>
						    <label for="password">Rôle</label>
						    <br>
					    	<?php
					    	//Condition pour savoir si la personne est un admin
					    	if($resInfo["idFonction"] == "1"){
								echo '<select class="form-control shadow" name="role">
									<option value="2">Visiteur</option>
									<option value="3">Comptable</option>
									<option value="1" selected>Admin</option>
								</select>';
							//Condition pour savoir si la personne est un visiteur
							}elseif($resInfo["idFonction"] == "2"){						    	
								echo '<select class="form-control shadow" name="role">
									<option value="2" selected>Visiteur</option>
									<option value="3">Comptable</option>
									<option value="1">Admin</option>
								</select>';
							//Condition pour savoir si la personne est un comptable
							}else{
								echo '<select class="form-control shadow" name="role">
									<option value="2">Visiteur</option>
									<option value="3" selected>Comptable</option>
									<option value="1">Admin</option>
								</select>';
							}?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-md-offset-3">
						    <br>
						    <!--Bouton chacher pour transmetre l'id de la personne-->
						    <?php echo '<input type="hidden" name="id" value='.$_GET['id'].'>'; ?>
							<button type="submit" class="btn btn-warning shadow" id="buttonvalid" name="valider" value="valider">Modifier</button>
						</div>
					</div>
				</form>
	        	<div class="row"><br></div>
	        </section>

	    </div>
	    <!--inclution du footer-->
	    <?php include('../include/footer.php'); ?>
	</body>
</html>

