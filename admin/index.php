<?php
include('include/verification.php')
?>
<!DOCTYPE html>
<html lang="en">
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
	        									<!--Début du formulaire Au forfait--> 
	        	<br>
	        	<div class="row">
	        	<form id="formFraisForfait" method="post" action="index.php">
	        		<div class="col-md-2 col-md-offset-3">
                		<input type="submit" class="btn btn-default shadow" name="ajouter" value="Ajouter utilisateur"/>
                	</div>
	        	</form>
	        	</div>
	        	<div class="row"><br></div>
	        </section>
	        
	        	<?php include('../include/utili.php') ?>
	        
	        <div class="row contentDate">
		        <div class="col-md-12 text-center DateStyle">
		        	<br>
	        	</div>		
	        </div>
	        <section class="container-fluid" id="forfait">
	        	<?php include('../include/user.php') ?>
	        </section>
	    </div>
	    <?php include('../include/footer.php'); ?>
	</body>
</html>

