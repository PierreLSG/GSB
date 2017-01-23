<?php
session_name('appli_frais');
session_start();
include('../include/bdd.php');
if(isset($_POST['modifier'])){
	if(isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['confirmation']) && !empty($_POST['confirmation'])){
		if($_POST['mdp'] == $_POST['confirmation']){
			//mise en forme des variables
			$idUser = $_SESSION['id'];
			$mdp = strip_tags($_POST['mdp']);
			$mdp = sha1($mdp);
			//requete oour metre a jour la bdd
			$req = $bdd->prepare('UPDATE visiteur SET mdp = :mdp WHERE id = :id');
			$req->execute(array(
				':mdp'=> $mdp,
				':id'=> $idUser));
			if($_SESSION['fonction'] == "1"){
				//Renvoi sur la page SaisieFrais.php
				header('location: ../admin/profile.php');
			}
			if($_SESSION['fonction'] == "2"){
				//Renvoi sur la page SaisieFrais.php
				header('location: ../visiteur/profile.php');
			}
			if($_SESSION['fonction'] == "3"){
				//Renvoi sur la page SaisieFrais.php
				header('location: ../comptable/profile.php');
			}
		}else{
			if($_SESSION['fonction'] == "1"){
				echo "<script> 
						selectedUrl='http://localhost/GSB/admin/modifMdp.php'
						alert('La confirmation ne correspond pas au mot de passe');
						document.location = selectedUrl;
					  </script>";
			}
			if($_SESSION['fonction'] == "2"){
				echo "<script> 
						selectedUrl='http://localhost/GSB/visiteur/modifMdp.php'
						alert('La confirmation ne correspond pas au mot de passe');
						document.location = selectedUrl;
					  </script>";
			}
			if($_SESSION['fonction'] == "3"){
				echo "<script> 
						selectedUrl='http://localhost/GSB/comptable/modifMdp.php'
						alert('La confirmation ne correspond pas au mot de passe');
						document.location = selectedUrl;
					  </script>";
			}
		}
	}else{
		if($_SESSION['fonction'] == "1"){
			echo "<script> 
						selectedUrl='http://localhost/GSB/admin/modifMdp.php'
						alert('Veuillez remplire tout les champs');
						document.location = selectedUrl;
					  </script>";
		}
		if($_SESSION['fonction'] == "2"){
			echo "<script> 
						selectedUrl='http://localhost/GSB/visiteur/modifMdp.php'
						alert('Veuillez remplire tout les champs');
						document.location = selectedUrl;
					  </script>";
		}
		if($_SESSION['fonction'] == "3"){
			echo "<script> 
						selectedUrl='http://localhost/GSB/comptable/modifMdp.php'
						alert('Veuillez remplire tout les champs');
						document.location = selectedUrl;
					  </script>";
		}
	}
}
?>