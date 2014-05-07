<?php 
include_once("Membre.php");

if( Membre::estAdmin($_SESSION['connex_active']) )
	Membre::supprimerMembre($_GET['id']);

header("Location: administration.php");
?>