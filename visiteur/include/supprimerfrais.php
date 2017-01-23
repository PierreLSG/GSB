<?php
if($_POST["frais"] == "forfait"){
    //Declaration des variables    
    $idLigneFraisForfait = strip_tags($_POST['id']);
    //Suppression de la ligne dans la bdd
    $reqDel = $bdd->prepare('DELETE FROM LigneFraisForfait WHERE id = :idLigneFraisForfait');
    $reqDel -> execute(array(
        ':idLigneFraisForfait'=> $idLigneFraisForfait));
    //Redirection vers la page SaisieFrais.php
    header('location: index.php');
    
}elseif($_POST["frais"] == "horsforfait"){
    //Declaration des variables    
    $idLigneFraisHorsForfait = strip_tags($_POST['id']);
    //Suppression de la ligne dans la bdd
    $reqDel = $bdd->prepare('DELETE FROM LigneFraisHorsForfait WHERE id = :idLigneFraisHorsForfait');
    $reqDel -> execute(array(
        ':idLigneFraisHorsForfait'=> $idLigneFraisHorsForfait));
    header('location: index.php');
}
?>