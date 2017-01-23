<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");

if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['cp']) && !empty($_POST['cp']) && isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['date']) && !empty($_POST['date'])){

	//mise en forme des variables
	$id = $_SESSION['id'];
	$nom = strip_tags($_POST['nom']);
	$prenom = strip_tags($_POST['prenom']);
	$login = strip_tags($_POST['login']);
	$adresse = strip_tags($_POST['adresse']);
	$cp = strip_tags($_POST['cp']);
	$ville = strip_tags($_POST['ville']);
	//mise ne forme de la date
	$dateEmbauche = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
	//requette pour mettre a jour la bdd
	$req = $bdd->prepare('UPDATE visiteur SET nom = :nom, prenom = :prenom, login = :login, adresse = :adresse, cp = :cp, ville = :ville, dateEmbauche = :dateEmbauche WHERE id = :id');
	$req->execute(array(
		':nom' => $nom,
		':prenom' => $prenom,
		':login' => $login,
		':adresse' => $adresse,
		':cp' => $cp,
		':ville' => $ville,
		':dateEmbauche' => $dateEmbauche,
		':id' => $id));
	if($_SESSION['fonction'] == "3"){
	  header('Location: ../comptable/profile.php');
		  exit();
	}
	if($_SESSION['fonction'] == "2"){
	  header('Location: ../visiteur/profile.php');
		  exit();
	}
	if($_SESSION['fonction'] == "1"){
	  header('Location: ../admin/profile.php');
		  exit();
	}
}else{
	echo "<script> 
			selectedUrl='http://localhost/GSB/admin/profile.php'
			alert('Veuillez remplire tout les champs');
			document.location = selectedUrl;
		  </script>";
	
}
?>