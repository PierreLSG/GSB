<?php
//on Vérifie que l'utilisateur a choisi ajouter
if(isset($_POST["ajouter"])){
	?>
	<div class="row contentDate">
        <div class="col-md-12 text-center DateStyle">
        	<br>
    	</div>		
    </div>
    <section class="container-fluid" id="forfait">
		<form id="ajoutUtili" method="post" action="../ttt/ajoutUtili.php">
			<div class="row">
				<div class="col-md-2 col-md-offset-3">
					<label for="text">Login</label>
				    <br>
					<input type="text" class="form-control shadow" name="login"> 
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-3">
				    <br>
				    <label for="password">Mot de passe</label>
				    <br>
						<input type="password" class="form-control shadow" name="mdp">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-3">
				    <br>
				    <label for="password">Rôle</label>
				    <br>
						<select class="form-control shadow" name="role">
							<option value="2">Visiteur</option>
							<option value="3">Comptable</option>
							<option value="1">Admin</option>
						</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-3">
				    <br>
					<button type="submit" class="btn btn-success shadow" id="buttonvalid" name="valider" value="valider">Valider</button>
					<a href="index.php" class="btn btn-danger shadow">Annuler</a>
				</div>
			</div>
		</form>
		<br>
	</section>
	
	<?php
}
?>