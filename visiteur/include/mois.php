<?php
    //mois actuelle
    $mois01 = date("Y-m-d");
    $mois1 = date("n", strtotime($mois01));
    //mois moins 1
    $mois02 = date("Y-m-d", strtotime("-1 month"));
    $mois2 = date("n", strtotime($mois02));
    //mois moins 2
    $mois03 = date("Y-m-d", strtotime("-2 month"));
    $mois3 = date("n", strtotime($mois03));
    //mois moins 3
    $mois04 = date("Y-m-d", strtotime("-3 month"));
    $mois4 = date("n", strtotime($mois04)); 
    $mois05 = date("Y-m-d", strtotime("-4 month"));
    $mois5 = date("n", strtotime($mois05)); 
    $mois06 = date("Y-m-d", strtotime("-5 month"));
    $mois6 = date("n", strtotime($mois06)); 
    $mois07 = date("Y-m-d", strtotime("-6 month"));
    $mois7 = date("n", strtotime($mois07));
    $mois08 = date("Y-m-d", strtotime("-7 month")); 
    $mois8 = date("n", strtotime($mois08)); 
    $mois09 = date("Y-m-d", strtotime("-8 month"));
    $mois9 = date("n", strtotime($mois09));
    $mois010 = date("Y-m-d", strtotime("-9 month")); 
    $mois10 = date("n", strtotime($mois010));
    $mois011 = date("Y-m-d", strtotime("-10 month")); 
    $mois11 = date("n", strtotime($mois011));
    $mois012 = date("Y-m-d", strtotime("-11 month")); 
    $mois12 = date("n", strtotime($mois012));
    $mois013 = date("Y-m-d", strtotime("-12 month"));
    $mois13 = date("n", strtotime($mois013));
    
    //mise dans un tableau des nom des mois
    $mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", 
    "Septembre", "Octobre", "Novembre", "Décembre");
    //attributions de chaque nom de mois
    $mois1 = $mois_fr[$mois1];
    $mois2 = $mois_fr[$mois2];
    $mois3 = $mois_fr[$mois3];
    $mois4 = $mois_fr[$mois4];
    $mois5 = $mois_fr[$mois5];
    $mois6 = $mois_fr[$mois6];
    $mois7 = $mois_fr[$mois7];
    $mois8 = $mois_fr[$mois8];
    $mois9 = $mois_fr[$mois9];
    $mois10 = $mois_fr[$mois10];
    $mois11 = $mois_fr[$mois11];
    $mois12 = $mois_fr[$mois12];
    $mois13 = $mois_fr[$mois13];
?>