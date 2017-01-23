<?php
//Demarage de la session nommée appli_frais
session_name('appli_frais');
session_start();
//inclusion de la bdd
include('../include/bdd.php');
//condition pour si l'utilisateur est connecté
if(isset($_SESSION["id"])){
    //condition pour savoir si l'utilisateur est un visiteur
    if($_SESSION['fonction'] == "3"){
        //redirection vers la page de déconnexion
        header('location:../include/deconnexion.php ');
}
}else{
    //redirection vers la page de déconnexion
    header('location:../include/deconnexion.php ');
}
//Requete pour aller chercher les infos de l'utilisateur
$reqInfo = $bdd->prepare('SELECT * FROM visiteur WHERE id = :id');
$reqInfo->execute(array(
  ':id'=> $_SESSION['id']));
$resInfo = $reqInfo->fetch();
//Condition pour savoir si l'utilisateur a ses info remplis
if(!isset($resInfo['nom']) && !isset($resInfo['prenom']) && !isset($resInfo['adresse']) && !isset($resInfo['cp']) && !isset($resInfo['ville']) && !isset($resInfo['dateEmbauche'])){
	//Script qui informe l'utilsateur n'a pas ces info remplis et le redirige vers la page profil.php
  	echo "<script> 
      		selectedUrl='http://localhost/GSB/visiteur/profile.php'
      		alert('Veuillez remplire votre profile');
      		document.location = selectedUrl;
     	  </script>";
}
?>