<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");
//requette pour etre sur que tout les champ sont rempli et contiennent bien quelque choses
if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['role']) && !empty($_POST['role'])){
	//Mise ne place des variables
	$login = strip_tags($_POST['login']);
	$mdp = strip_tags($_POST['mdp']);
	$mdp = sha1($mdp);
	$idFonction = $_POST['role'];
	//requette pour rentré l'utilisateur dans la basse de donnée
	$req = $bdd->prepare('INSERT INTO visiteur (login, mdp, idFonction) VALUES (:login, :mdp, :idFonction)');
	$req->execute(array(
		':login'=>$login,
		':mdp'=>$mdp,
		':idFonction'=>$idFonction));
	//redirection
	header('location: ../admin/');

}else{
	//Script qui nous dit de remplire tout les champs et qui renvoie à la page admin.php
	echo "<script> 
			selectedUrl='http://localhost/GSB/admin/'
			alert('Veuillez remplire tout les champs');
			document.location = selectedUrl;
		  </script>";
}
?>