<?php
//Demarage de la session nommée appli_frais
session_name('appli_frais');
session_start();
//Condition pour savoir si l'utilisateur est connecté
if(isset($_SESSION["id"])){
	//Condition pour savoir si l'utilisateur est un comptable
	if($_SESSION['fonction'] == "2"){
		//Redirection vers la page de log si il n'est pas comptable
	     header('location:../include/deconnexion.php');
	}
}else{
	//Redirection vers la page de log si il n'est pas comptable
    header('location:../include/deconnexion.php');
}
//inclusion de la basse de donnée
include('../include/bdd.php');
//Requete pour aller chercher les infos de l'utilisateur
$reqInfo = $bdd->prepare('SELECT * FROM visiteur WHERE id = :id');
$reqInfo->execute(array(
  ':id'=> $_SESSION['id']));
$resInfo = $reqInfo->fetch();
//Condition pour savoir si l'utilisateur a ses info remplis
if(empty($resInfo['nom']) && empty($resInfo['prenom']) && empty($resInfo['adresse']) && empty($resInfo['cp']) && empty($resInfo['ville']) && $resInfo['dateEmbauche'] == "0000-00-00"){
	//Script qui informe l'utilsateur n'a pas ces info remplis et le redirige vers la page profil.php
  	echo "	<script> 
		      selectedUrl='http://localhost/GSB/comptable/profile.php'
		      alert('Veuillez remplire votre profile');
		      document.location = selectedUrl;
      		</script>";
}
?>