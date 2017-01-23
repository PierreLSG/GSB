<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");

if($_SESION['fonction'] != "1"){
	$id = strip_tags($_GET['id']);

	$req = $bdd->prepare('DELETE FROM visiteur WHERE id = :id');
	$req->execute(array(
		':id'=>$id));
	//redirection
	header('location: ../admin/');

}else{
	//redirection
	header('location: ../index.php');
}
?>