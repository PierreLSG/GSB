<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");
//Condition pour effectuer la sauvegarde dans la bdd
if(isset($_POST['selectForfait']) && !empty($_POST['selectForfait']) && isset($_POST['quantite']) && !empty($_POST['quantite']) && isset($_POST['date']) && !empty($_POST['date'])){
	//Déclaration des variables
	$idLigneFraisForfait = strip_tags($_POST['idLigneFraisForfait']);
	$idVisiteur = strip_tags($_POST['idVisiteur']);
	$idFraisforfais = strip_tags($_POST['selectForfait']);
	$quantite = strip_tags($_POST['quantite']);
	$idEtat = "2";
	//Mise ne formt de la date
	$dateFrais = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
	$dateModif = date("y.m.d");
	//Requette qui ajoute les valeur dans la base de donnée
	$reqFichefrais = $bdd->prepare('UPDATE LigneFraisForfait SET  mois = :dateFrais, quantite = :quantite, idFraisForfait = :idFraisforfais, date = :date WHERE id = :idLigneFraisForfait');
	$reqFichefrais->execute(array(
		':dateFrais'=>$dateFrais,
		':quantite'=>$quantite,
		':idFraisforfais'=>$idFraisforfais,
		':date'=> $dateModif,
		':idLigneFraisForfait'=>$idLigneFraisForfait));
	if($_SESSION['fonction'] == "2"){
		//Renvoi sur la page SaisieFrais.php
		header('location: ../visiteur/');
	}if($_SESSION['fonction'] == "3"){
		//Renvoi sur la page SaisieFrais.php
		header('location: ../comptable/?id='.$idVisiteur.'&envoi=Valider');
	}


}else{	
	if($_SESSION['fonction'] == "2"){
		//Renvoi sur la page SaisieFrais.php
		echo "<script> 
			selectedUrl='http://localhost/GSB/visiteur/'
			alert('Veuillez remplire tout les champs');
			document.location = selectedUrl;
		  </script>";
	}if($_SESSION['fonction'] == "3"){
		//Renvoi sur la page SaisieFrais.php
		echo "<script> 
			selectedUrl='http://localhost/GSB/comptable/?id=".$idVisiteur."&envoi=Valider'
			alert('Veuillez remplire tout les champs');
			document.location = selectedUrl;
		  </script>";
	}

	
			
}
?>