<?php
//Demarage de la session nommée appli_frais
session_name('appli_frais');
session_start();
//inclusion de la bdd
include('../include/bdd.php');
//Condition pour savoir si l'utilisateur est connecter
if(isset($_SESSION["id"])){
	//Condition pour savoir si l'utilisateur est un admin
	if($_SESSION['fonction'] != "1"){
		//redirection vers pas page de log
    	header('location:../index.php ');
	}
}else{
	//redirection vers pas page de log
	header('location:../index.php ');
}
?>