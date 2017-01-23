<?php
$jour = date("d");
if($jour <= 10){
    $mois = date("m") - 1;
    switch ($mois){
        case 01:
            $mois = "Janvier";
            break;
        case 02:
            $mois = "Fevrier";
            break;
        case 03:
            $mois = "Mars";
            break;
        case 04:
            $mois = "Avril";
            break;
        case 05:
            $mois = "Mai";
            break;
        case 06:
            $mois = "Juin";
            break;
        case 07:
            $mois = "juillet";
            break;
        case 08:
            $mois = "Aout";
            break;
        case 09:
            $mois = "Septembre";
            break;
        case 10:
            $mois = "Octobre";
            break;
        case 11:
            $mois = "Novembre";
            break;
        case 12:
            $mois = "Decembre";
            break;

    }
}else{
    $mois = date("m") - 0;
    switch ($mois){
        case 1:
            $mois = "Janvier";
            break;
        case 2:
            $mois = "Fevrier";
            break;
        case 3:
            $mois = "Mars";
            break;
        case 4:
            $mois = "Avril";
            break;
        case 5:
            $mois = "Mai";
            break;
        case 6:
            $mois = "Juin";
            break;
        case 7:
            $mois = "juillet";
            break;
        case 8:
            $mois = "Aout";
            break;
        case 9:
            $mois = "Septembre";
            break;
        case 10:
            $mois = "Octobre";
            break;
        case 11:
            $mois = "Novembre";
            break;
        case 12:
            $mois = "Decembre";
            break;
    }
}
$anne = date("Y");
?>