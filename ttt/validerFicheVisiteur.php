<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");
if($_POST['Valider']){
	if(isset($_POST['idFichefrais']) && !empty($_POST['idFichefrais'])){
		//mise en forme des variable
		$idFichefrais = strip_tags($_POST['idFichefrais']);
		$montant = strip_tags($_POST['montant']);
		$nbJustificatif = strip_tags($_POST['nbJustificatif']);
		$idEtat = "4";
		//requte pour mettre a jour la bdd
		$req = $bdd->prepare('UPDATE fichefrais SET idEtat = :idEtat, montantValide = :montantValide, nbJustificatifs = :nbJustificatif WHERE id = :id');
		$req->execute(array(
			':idEtat'=> $idEtat,
			':montantValide'=> $montant,
			':nbJustificatif'=> $nbJustificatif,
			':id'=> $idFichefrais));

		header('location: ../comptable/');
	}
}
?>