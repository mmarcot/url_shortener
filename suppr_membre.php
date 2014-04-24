<?php 
include_once("Membre.php");

Membre::supprimerMembre($_GET['id']);
header("Location: administration.php");
?>