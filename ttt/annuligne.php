<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");
//Condition pour effectuer la sauvegarde dans la bdd
if($_POST['AnnulerFrais']){
	if(isset($_POST['id']) && !empty($_POST['id'])){
		//mise en forme des variables
		$idLigne = strip_tags($_POST['id']);
		$valider = "0";
		$idVisiteur = strip_tags($_POST['idVisiteur']);
		//requete pour valider la ligne
		$reqValider = $bdd->prepare('UPDATE lignefraisforfait SET valider = :valider WHERE id = :id');
		$reqValider->execute(array(
			':valider'=> $valider,
			':id'=> $idLigne));
		//Renvoi sur la page 
		header('location: ../comptable/?id='.$idVisiteur.'&envoi=Valider');
	}else{
		echo "<script> 
				selectedUrl='http://localhost/GSB/comptable/?id=".$idVisiteur."&envoi=Valider'
				alert('Erreur');
				document.location = selectedUrl;
			  </script>";
	}
}if($_POST['AnnulerFraisHF']){
	if(isset($_POST['id']) && !empty($_POST['id'])){
		//mise en forme des variables
		$idLigne = strip_tags($_POST['id']);
		$valider = "0";
		$idVisiteur = strip_tags($_POST['idVisiteur']);
		//requete pour valider la ligne
		$reqValider = $bdd->prepare('UPDATE lignefraishorsforfait SET valider = :valider WHERE id = :id');
		$reqValider->execute(array(
			':valider'=> $valider,
			':id'=> $idLigne));
		//Renvoi sur la page 
		header('location: ../comptable/?id='.$idVisiteur.'&envoi=Valider');
	}else{
		echo "<script> 
				selectedUrl='http://localhost/GSB/comptable/?id=".$idVisiteur."&envoi=Valider'
				alert('Erreur');
				document.location = selectedUrl;
			  </script>";
	}
}
?>