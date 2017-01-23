<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");
//Condition pour effectuer la sauvegarde dans la bdd
if(isset($_POST['selectForfait']) && !empty($_POST['selectForfait']) && isset($_POST['quantite']) && !empty($_POST['quantite']) && isset($_POST['date']) && !empty($_POST['date'])){
	//Date un ans en arrière
	$dateLastYear = date('Y-m-d', strtotime('-1 year'));
	//date du frais
	$dateFrais = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
	//Condition pour vérifier si la date frais est pas plus d'un an
	if($dateFrais > $dateLastYear){
		//Déclaration des variables
		$idVisiteur = $_SESSION['id'];
		$idFraisforfais = strip_tags($_POST['selectForfait']);
		$quantite = strip_tags($_POST['quantite']);
		$dateDay = date('y.m.d');
		$day = date('d');
		$valider = "0";
		$idEtat = "2";
		//On verifie si on est pas au dessus du 10eme jour
		if($day <= 10){
			//si on est en dessous alors on enléve u mois a la date
			$dateDay = date('y.m.d', strtotime("-1 month",strtotime(date('Y-m-d'))));
		}
		//Requette qui vas chercher la bonne fiche frais
		$reqfiche = $bdd->prepare('SELECT id FROM FicheFrais WHERE MONTH(dateFrais) = MONTH(:dateFrais) AND YEAR(dateFrais) = YEAR(:dateFrais) AND idVisiteur = :idVisiteur AND idEtat = :idEtat');
		$reqfiche->execute(array(
			'dateFrais'=>$dateDay,
			':idVisiteur'=>$idVisiteur,
			':idEtat'=> $idEtat));
		$resfiche = $reqfiche->fetch();
		//Mise en variable de l'id de la fiche
		$idFicheFrais = $resfiche['id'];

		$dateDay = date('y.m.d');
		//Requette qui ajoute les valeur dans la base de donnée
		$reqFichefrais = $bdd->prepare('INSERT INTO ligneFraisForfait (idVisiteur, mois, quantite, idFraisforfait, idFicheFrais, date, valider) VALUES(:idVisiteur, :mois, :quantite, :idFraisforfait, :idFicheFrais, :date, :valider)');
		$reqFichefrais->execute(array(
			':idVisiteur'=>$idVisiteur,
			':mois'=>$dateFrais,
			':quantite'=>$quantite,
			':idFraisforfait'=>$idFraisforfais,
			':idFicheFrais'=>$idFicheFrais,
			':date'=>$dateDay,
			':valider'=> $valider));

		//Renvoi sur la page SaisieFrais.php
		header('location: ../visiteur/');
	}
	else{
		//Script qui nous dit que la date frais ne doit pas etre daté de plus d'un ans
		echo "<script> 
			selectedUrl='http://localhost/GSB/visiteur/'
			alert('le frais ne doit pas ne doit pas dater de plus de un an');
			document.location = selectedUrl;
		  </script>";
	}

}else{
	//Script qui nous dit de remplire tout les champs et qui renvoie à la page saisieFrais.php
	echo "<script> 
			selectedUrl='http://localhost/GSB/visiteur/'
			alert('Veuillez remplire tout les champs');
			document.location = selectedUrl;
		  </script>";
			
}
?>