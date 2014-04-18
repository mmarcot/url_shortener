<?php 
include_once("Membre.php");


if( isset($_SESSION['connex_active']) && Membre::estAdmin($_SESSION['connex_active']) ) {
	
	/**
	* Recuperation de l'id du membre anonyme
	*/	
	$id_anonyme = Membre::getIdFromPseudo("anonyme");
	
	
	
	/**
	*	Verification si l'id passer en get n'est pas id du membre anonyme
	*/
	if($_GET['id'] != $id_anonyme) {
		Membre::supprimerMembre($_GET['id']);
		header("Location: administration.php");
	}
	else {
		header("Location: administration.php");
	}
	
}
else {
	header("Location: index.php");
}
?>