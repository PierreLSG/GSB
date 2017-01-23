<?php
session_name('appli_frais');
session_start();
include("../include/bdd.php");
//Si il y as uploads d'un fichier
if($_FILES["fileselect"]["name"]){
	//Condition pour effectuer la sauvegarde dans la bdd
	if(isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['montant']) && !empty($_POST['montant'])){
		//Date un ans en arrière
		$dateLastYear = date('Y-m-d', strtotime('-1 year'));
		//date du frais
		$dateFrais = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
		//Condition pour vérifier si la date frais est pas plus d'un an
		if($dateFrais > $dateLastYear){
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
						selectedUrl='http://localhost/visiteur/'
						alert('Le fichier n\'est pas une image');
						document.location = selectedUrl;
					  </script>";
			        $uploadOk = 0;
			    }
			    //si le fichier existe déjà dans le répertoire de déstination
			    if(file_exists($target_file))
			    {
			    	echo "<script> 
						selectedUrl='http://localhost/visiteur/'
						alert('Le nom de l\'image existe déjà. Veuillez changer de nom ou d\'image.');
						document.location = selectedUrl;
					  </script>";
			        $uploadOk = 0;
			    }
			 
			    //verifie le poids de l'image
			    if ($_FILES["fileselect"]["size"] > 5000000)
			    {
			    	echo "<script> 
						selectedUrl='http://localhost/visiteur/'
						alert('Le fichier est trop volumineux. Taille max: 5Mo');
						document.location = selectedUrl;
					  </script>"; 
			    }
			         
			    //verifier l'extention de l'image
			    if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF" && $imageFileType != "pdf" && $imageFileType != "PDF")
			    {
			    	echo "<script> 
						selectedUrl='http://localhost/GSB/visiteur/'
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
			    	if (move_uploaded_file($_FILES["fileselect"]["tmp_name"], $target_file))
			        {
						//Declaration des variables
						$libelle = strip_tags($_POST['libelle']);
						$montant = strip_tags($_POST['montant']);
						$idVisiteur = $_SESSION['id'];
						$dateFrais = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
						$dateDay = date('y.m.d');
						$valider = "0";
						$idEtat = "2";

						$day = date('d');
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
						$reqFichefrais = $bdd->prepare('INSERT INTO ligneFraisHorsForfait (idVisiteur, date, montant, libelle, idFicheFrais, justificatif, dateSaissie, valider) VALUES(:idVisiteur, :dateFrais, :montant, :libelle, :idFicheFrais, :justificatif, :dateSaissie, :valider)');
						$reqFichefrais->execute(array(
							':idVisiteur'=>$idVisiteur,
							':dateFrais'=>$dateFrais,
							':montant'=>$montant,
							':libelle'=>$libelle,
							':idFicheFrais'=>$idFicheFrais,
							':justificatif'=>$_FILES["fileselect"]["name"],
							':dateSaissie'=>$dateDay,
							':valider'=>$valider));

						//Renvoi sur la page SaisieFrais.php
						header('location: ../visiteur/');

					}
				}
			}
		}else{
			//Script qui nous dit que la date frais ne doit pas etre daté de plus d'un ans
			echo "<script> 
				selectedUrl='http://localhost/GSB/visiteur/'
				alert('le frais ne doit pas ne doit pas dater de plus de un an');
				document.location = selectedUrl;
			  </script>";
		}
	}else{
		echo "<script> 
			selectedUrl='http://localhost/GSB/visiteur/'
			alert('Veuillez remplire tout les champs');
			document.location = selectedUrl;
		  </script>";
	}

}else{
	//Condition pour effectuer la sauvegarde dans la bdd
	if(isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['montant']) && !empty($_POST['montant'])){
		//Date un ans en arrière
		$dateLastYear = date('Y-m-d', strtotime('-1 year'));
		//date du frais
		$dateFrais = date('Y-m-d', strtotime($_POST['date']));
		//Condition pour vérifier si la date frais est pas plus d'un an
		if($dateFrais > $dateLastYear){
			//Declaration des variables
			$libelle = strip_tags($_POST['libelle']);
			$montant = strip_tags($_POST['montant']);
			$idVisiteur = $_SESSION['id'];
			$dateFrais = date('Y-m-d', strtotime(strip_tags($_POST['date'])));
			$dateDay = date('y.m.d');
			$day = date('d');
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

			//Requette qui ajoute les valeur dans la base de donnée
			$reqFichefrais = $bdd->prepare('INSERT INTO ligneFraisHorsForfait (idVisiteur, date, montant, libelle, idFicheFrais, justificatif, dateSaissie) VALUES(:idVisiteur, :dateFrais, :montant, :libelle, :idFicheFrais, :justificatif, :dateSaissie)');
			$reqFichefrais->execute(array(
				':idVisiteur'=>$idVisiteur,
				':dateFrais'=>$dateFrais,
				':montant'=>$montant,
				':libelle'=>$libelle,
				':idFicheFrais'=>$idFicheFrais,
				':justificatif'=>$_FILES["fileselect"]["name"],
				':dateSaissie'=>$dateDay));

			//Renvoi sur la page SaisieFrais.php
			header('location: ../visiteur');
		}else{
			//Script qui nous dit que la date frais ne doit pas etre daté de plus d'un ans
			echo "<script> 
				selectedUrl='http://localhost/GSB/visiteur/'
				alert('le frais ne doit pas ne doit pas dater de plus de un an');
				document.location = selectedUrl;
			  </script>";
		}

	}else{

		echo "<script> 
				selectedUrl='http://localhost/GSB/visiteur/'
				alert('Veuillez remplire tout les champs');
				document.location = selectedUrl;
			  </script>";
				

	}
}
/*
*/
?>