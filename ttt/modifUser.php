<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");

if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['role']) && !empty($_POST['role']) && isset($_POST['id']) && !empty($_POST['id'])){

	$login = strip_tags($_POST['login']);
	$role = strip_tags($_POST['role']);
	$id = strip_tags($_POST['id']);

	$req = $bdd->prepare('UPDATE visiteur SET login = :login, idFonction = :role WHERE id = :id');
	$req->execute(array(
		':login'=> $login,
		':role'=> $role,
		':id'=> $id));

	//Renvoi sur la page SaisieFrais.php
	header('location: ../admin/');
}else{
	echo "<script> 
			selectedUrl='http://localhost/GSB/admin/'
			alert('Veuillez remplire tout les champs');
			document.location = selectedUrl;
		  </script>";
}