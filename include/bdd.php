<?php
try {$bdd = new PDO('mysql:host=localhost;dbname=gsb_frais', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
}
catch (Exception $e) {die("L'accés à la base de donnée est impossible.");}
?>