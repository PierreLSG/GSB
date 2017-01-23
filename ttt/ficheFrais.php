<?php
//Inclusion de la bdd
include("../include/bdd.php");
//Recupération des variable
$idVisiteur = $_SESSION['id'];
$jour = date("d");
$date = date('Y-m-d', strtotime("-1 month",strtotime(date('Y-m-d'))));
//Condition pour vérifier si on est en desous du 10 eme jour
if($jour <= 10){
	//requette pour voir si il y as une fiche frais qui est a la bonne date
	$reqFiche = $bdd->prepare('SELECT count(id) as id FROM fichefrais WHERE idVisiteur = :idVisiteur AND MONTH(dateFrais) = MONTH(:dateFrais) AND YEAR(dateFrais) = YEAR(:dateFrais) AND idEtat = :idEtat ');
	$reqFiche->execute(array(
		':idVisiteur'=>$idVisiteur,
		':dateFrais'=>$date,
		':idEtat'=>2));
	$resFiche = $reqFiche->fetch();
	//Recupération du compte des id
	$idFicheFrais = $resFiche['id'];
	//Si le compte renvoie 0 alors on lui crée une fiche frais
	if($idFicheFrais == 0){
		//Mise en place des variables
		$idEtat = 2;
		$montantValide = 0;
		$nbJustificatifs = 0;
		//Requette pour créer une nouvelle fiche de frais
		$reqFicheFrais = $bdd->prepare('INSERT INTO fichefrais (idVisiteur, idEtat, dateFrais, nbJustificatifs, montantValide, dateModif) VALUES (:idVisiteur, :idEtat, :dateFrais, :nbJustificatifs, :montantValide, :dateModif)');
		$reqFicheFrais->execute(array(
			':idVisiteur'=>$idVisiteur,
			':idEtat'=>$idEtat,
			'dateFrais'=>$date,
			':nbJustificatifs'=>$nbJustificatifs,
			':montantValide'=>$montantValide,
			':dateModif'=>$date));
	}
//Si on est au dessus du 10eme jour
}else{
	//On change idEtat de la fiche du mois précédent
	$reqFiche = $bdd->prepare('UPDATE fichefrais set idEtat = :idEtat WHERE idVisiteur = :idVisiteur AND MONTH(dateFrais) = MONTH(:dateFrais) AND YEAR(dateFrais) = YEAR(:dateFrais)');
	$reqFiche->execute(array(
		'idEtat'=>1,
		':idVisiteur'=>$idVisiteur,
		':dateFrais'=>$date));
	//Mise ne place des variabels
	$date = date('Y-m-d');
	$idEtat = 2;
	$montantValide = 0;
	$nbJustificatifs = 0;
	//requette pour voir si il y as une fiche frais qui est a la bonne date
	$reqFiche = $bdd->prepare('SELECT count(id) as id FROM fichefrais WHERE idVisiteur = :idVisiteur AND MONTH(dateFrais) = MONTH(:dateFrais) AND YEAR(dateFrais) = YEAR(:dateFrais) AND idEtat = :idEtat ');
	$reqFiche->execute(array(
		':idVisiteur'=>$idVisiteur,
		':dateFrais'=>$date,
		':idEtat'=>2));
	$resFiche = $reqFiche->fetch();
	//Recupération du compte des id
	$idFicheFrais = $resFiche['id'];

	//Requette pour créer une nouvelle fiche de frais
	if($idFicheFrais == 0){
		$reqFicheFrais = $bdd->prepare('INSERT INTO fichefrais (idVisiteur, idEtat, dateFrais, nbJustificatifs, montantValide, dateModif) VALUES (:idVisiteur, :idEtat, :dateFrais, :nbJustificatifs, :montantValide, :dateModif)');
			$reqFicheFrais->execute(array(
				':idVisiteur'=>$idVisiteur,
				':idEtat'=>$idEtat,
				'dateFrais'=>$date,
				':nbJustificatifs'=>$nbJustificatifs,
				':montantValide'=>$montantValide,
				':dateModif'=>$date));
	}


}


?>