<?php
if($frais == "forfait"){

    //Declaration des variables    
    $idLigneFraisForfait = strip_tags($_POST['id']);

    //Suppression de la ligne dans la bdd
    $reqDel = $bdd->prepare('DELETE FROM LigneFraisForfait WHERE id = :idLigneFraisForfait');
    $reqDel -> execute(array(
        ':idLigneFraisForfait'=> $idLigneFraisForfait));

    //Redirection vers la page SaisieFrais.php
    header('location: SaisieFrais.php');

}elseif($frais == "horsforfait"){

    //Declaration des variables    
    $idLigneFraisHorsForfait = strip_tags($_POST['id']);

    //Suppression de la ligne dans la bdd
    $reqDel = $bdd->prepare('DELETE FROM LigneFraisHorsForfait WHERE id = :idLigneFraisHorsForfait');
    $reqDel -> execute(array(
        ':idLigneFraisHorsForfait'=> $idLigneFraisHorsForfait));
    header('location: SaisieFrais.php');

}
