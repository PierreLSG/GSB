strip_tags(<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");
//Si il y as uploads d'un fichier
if($_FILES["fileselect"]["name"]){
	if(isset($_POST['envoi'])){
	    //répertoire de déstination
	    $target_dir = "../uploads/";
	    //nom du fichier dans le repertoire
	    $target_file = $target_dir . basename($_FILES["fileselect"]["name"]);
	    //initialisation de la variable update ok
	    $uploadOk = 1;
	    //initialisation des erreur
	    if(!is_dir($target_dir))
	    {
	    	echo "<script> 
				selectedUrl='http://localhost/GSB/SaisieFrais.php'
				alert('Le dossier n\'existe pas, contacter le webmaster');
				document.location = selectedUrl;
			  </script>";
	        $uploadOk = 0;
	    }  
	    //extention de l'image
	    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	    //verifier que c'est bien une image
	    $check = ($_FILES["fileselect"]["tmp_name"]);

	    if($check !== false)
	    {
	        $uploadOk = 1;
	    }
	    else
	    {
	    	echo "<script> 
				selectedUrl='http://localhost/GSB/SaisieFrais.php'
				alert('Le fichier n\'est pas une image');
				document.location = selectedUrl;
			  </script>";
	        $uploadOk = 0;
	    }
	    //si le fichier existe déjà dans le répertoire de déstination
	    if(file_exists($target_file))
	    {
	    	echo "<script> 
				selectedUrl='http://localhost/GSB/SaisieFrais.php'
				alert('Le nom de l\'image existe déjà. Veuillez changer de nom ou d\'image.');
				document.location = selectedUrl;
			  </script>";
	        $uploadOk = 0;
	    }
	 
	    //verifie le poids de l'image
	    if ($_FILES["fileselect"]["size"] > 5000000)
	    {
	    	echo "<script> 
				selectedUrl='http://localhost/GSB/SaisieFrais.php'
				alert('Le fichier est trop volumineux. Taille max: 5Mo');
				document.location = selectedUrl;
			  </script>"; 
	    }
	         
	    //verifier l'extention de l'image
	    if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF" && $imageFileType != "pdf" && $imageFileType != "PDF")
	    {
	    	echo "<script> 
				selectedUrl='http://localhost/GSB/SaisieFrais.php'
				alert('Les images doivent etre au format: JPG, JPEG, PNG, GIF ou PDF.');
				document.location = selectedUrl;
			  </script>"; 
	        $uploadOk = 0;
	    }
	    //une erreur au moins
	    if ($uploadOk == 0)
	    {

	    }
	    else
	    {
	    	if (move_uploaded_file($_FILES["fileselect"]["tmp_name"], $target_file)){
				//Condition pour effectuer la sauvegarde dans la bdd
				if(isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['montant']) && !empty($_POST['montant'])){
					//Declaration des variables
					$idLigneFraisHorsForfait = $_POST['idLigneFraisHorsForfait'];
					$libelle = strip_tags($_POST['libelle']);
					$montant = strip_tags($_POST['montant']);
					$idVisiteur = strip_tags($_POST['idVisiteur']);
					$dateFrais = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
					$dateModif = date("y.m.d");
					//Requette qui ajoute les valeur dans la base de donnée
					$reqFichefrais = $bdd->prepare('UPDATE LigneFraisHorsForfait SET date = :dateFrais, montant = :montant, libelle = :libelle, justificatif = :justificatif WHERE id = :idLigneFraisHorsForfait');
					$reqFichefrais->execute(array(
						':dateFrais'=>$dateFrais,
						':montant'=>$montant,
						':libelle'=>$libelle,
						':justificatif'=>$_FILES["fileselect"]["name"],
						':idLigneFraisHorsForfait'=>$idLigneFraisHorsForfait));
					if($_SESSION['fonction'] == "2"){
						//Renvoi sur la page SaisieFrais.php
						header('location: ../visiteur/');
					}if($_SESSION['fonction'] == "3"){
						//Renvoi sur la page SaisieFrais.php
						header('location: ../comptable/?id='.$idVisiteur.'&envoi=Valider');
					}
				}else{
					if($_SESSION['fonction'] == "2"){
						//Renvoi sur la page SaisieFrais.php
						echo "<script> 
							selectedUrl='http://localhost/GSB/visiteur/'
							alert('Veuillez remplire tout les champs');
							document.location = selectedUrl;
						  </script>";
					}if($_SESSION['fonction'] == "3"){
						//Renvoi sur la page SaisieFrais.php
						echo "<script> 
							selectedUrl='http://localhost/GSB/comptable/?id=".$idVisiteur."&envoi=Valider'
							alert('Veuillez remplire tout les champs');
							document.location = selectedUrl;
						  </script>";
					}
				}
			}
		}
	}
}else{
	//Condition pour effectuer la sauvegarde dans la bdd
	if(isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['montant']) && !empty($_POST['montant'])){

		//Declaration des variables
		$idLigneFraisHorsForfait = strip_tags($_POST['idLigneFraisHorsForfait']);
		$libelle = strip_tags($_POST['libelle']);
		$montant = strip_tags($_POST['montant']);
		$idVisiteur = strip_tags($_POST['idVisiteur']);
		$idEtat = "2";
		$dateFrais = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
		$dateModif = date("y.m.d");
		//Requette qui ajoute les valeur dans la base de donnée
		$reqFichefrais = $bdd->prepare('UPDATE LigneFraisHorsForfait SET date = :dateFrais, montant = :montant, libelle = :libelle WHERE id = :idLigneFraisHorsForfait');
		$reqFichefrais->execute(array(
			':dateFrais'=>$dateFrais,
			':montant'=>$montant,
			':libelle'=>$libelle,
			':idLigneFraisHorsForfait'=>$idLigneFraisHorsForfait));
		if($_SESSION['fonction'] == "2"){
			//Renvoi sur la page SaisieFrais.php
			header('location: ../visiteur/');
		}
		if($_SESSION['fonction'] == "3"){
			//Renvoi sur la page SaisieFrais.php
			header('location: ../comptable/?id='.$idVisiteur.'&envoi=Valider');
		}
	}else{
		if($_SESSION['fonction'] == "2"){
		//Renvoi sur la page SaisieFrais.php
			echo "<script> 
				selectedUrl='http://localhost/GSB/visiteur/'
				alert('Veuillez remplire tout les champs');
				document.location = selectedUrl;
			  </script>";
		}
		if($_SESSION['fonction'] == "3"){
			//Renvoi sur la page SaisieFrais.php
			echo "<script> 
				selectedUrl='http://localhost/GSB/comptable/?id=".$idVisiteur."&envoi=Valider'
				alert('Veuillez remplire tout les champs');
				document.location = selectedUrl;
			  </script>";
		}
	}
}
?>