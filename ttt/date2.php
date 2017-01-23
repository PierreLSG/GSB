<?php
$anne = date("Y");
if($mois<=0){

    $anne = $anne -1;
}

switch ($mois){
    case -7:
        $mois = "Mai";
        break;
    case -6:
        $mois = "Juin";
        break;
    case -5:
        $mois = "Juillet";
        break;
    case -4:
        $mois = "Aout";
        break;
    case -3:
        $mois = "Septembre";
        break;
    case -2:
        $mois = "Octobre";
        break;
    case -1:
        $mois = "Novembre";
        break;
    case 0:
        $mois = "Decembre";
        break;
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

?>