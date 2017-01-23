<?php
//Lancement de la session
session_name('appli_frais');
session_start();
include("../include/bdd.php");
//Recupération de l'id de la fichefrais
$idFicheFrais = strip_tags($_POST['idFicheFrais']);
//Requette qui permet de savoir si il y as deja un commentaire ou non
$reqIdCommentaire = $bdd->prepare('SELECT count(id) as id FROM commentaire WHERE idFicheFrais = :idFicheFrais');
$reqIdCommentaire->execute(array(
	':idFicheFrais'=>$idFicheFrais));
$resIdCommentaire = $reqIdCommentaire->fetch();


//Condition de la présence ou non de commentaire dans la BDD
//Si il y as pas de commentaire pour cette fiche
if($resIdCommentaire['id'] == 0){
	//Condition pour savoir si les champs du formulaire sont présent et non vide
	if(isset($_POST['commentaire'])){
		//Mise en place des variables
		$commentaire = strip_tags($_POST['commentaire']);
		$idVisiteur = $_SESSION['id'];
		//Requette pour inserer les variable dans la BDD
		$reqCommentaire = $bdd->prepare('INSERT INTO commentaire (idVisiteur, idFicheFrais, commentaire) VALUES (:idVisiteur, :idFicheFrais,:commentaire)');
		$reqCommentaire->execute(array(
			':idVisiteur'=>$idVisiteur,
			':idFicheFrais'=>$idFicheFrais,
			':commentaire'=>$commentaire));
		//Renvoie vers la page SaisieFrais.php
		header('location: ../visiteur/');
	}
}
//Si il y as deja un commentaire pour cette fiche
else{
	//Condition pour savoir si les champs du formulaire sont présent et non vide
	if(isset($_POST['commentaire'])){
		//Mise en place des variable
		$commentaire = strip_tags($_POST['commentaire']);
		$idVisiteur = $_SESSION['id'];
		//Requete pour mettre a jour la bdd
		$reqCommentaire = $bdd->prepare('UPDATE commentaire SET commentaire = :commentaire WHERE idVisiteur = :idVisiteur AND idFicheFrais = :idFicheFrais');
		$reqCommentaire->execute(array(
			':commentaire'=>$commentaire,
			':idVisiteur'=>$idVisiteur,
			':idFicheFrais'=>$idFicheFrais));
		//Renvoie vers la page SaisieFrais.php
		header('location: ../visiteur/');
	}
}
?>