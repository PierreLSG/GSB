<?php 
 if(isset($_POST['connection']))
 {
        $login = strip_tags($_POST['login']);
        $mdp = strip_tags($_POST['mdp']);
		$mdp = sha1($mdp);
// Vérification de la validité des informations
	if($login AND $mdp)
    {
		include('bdd.php');		 
						 
		$req = $bdd->prepare('SELECT * FROM visiteur WHERE login= :login AND mdp= :mdp');
		$req->execute(array('login'=>$login,'mdp'=>$mdp));							 					 
		$resultat = $req->fetch();
								 
			if(!$resultat)
			{
				echo "<script> 
						alert('Mauvais login ou mot de passe');
			  		  </script>";
			}

			else
			{
				session_name('appli_frais');
				session_start();
				$_SESSION['id'] = $resultat['id'];
				$_SESSION['nom'] = $resultat['nom'];
				$_SESSION['prenom'] = $resultat['prenom'];
				$_SESSION['mdp'] = $mdp;
				$_SESSION['fonction'] = $resultat['idFonction'];

				if($_SESSION['fonction'] == "3"){
				  header('Location: comptable/');
 				  exit();
				}
				if($_SESSION['fonction'] == "2"){
				  header('Location: visiteur/');
 				  exit();
				}
				if($_SESSION['fonction'] == "1"){
				  header('Location: admin/');
 				  exit();
				}
			}
	}

	else
	{
		echo "<script> 
				alert('Veuillez remplire tout les champs');
	  		  </script>";

	}
}
?>