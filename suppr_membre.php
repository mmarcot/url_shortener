<?php 
include_once("Membre.php");


if( isset($_SESSION['connex_active']) && Membre::estAdmin($_SESSION['connex_active']) ) {
	Membre::supprimerMembre($_GET['id']);
	header("Location: administration.php");
}
else {
	header("Location: index.php");
}
?>