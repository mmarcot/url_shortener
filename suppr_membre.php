<?php 
include_once("Membre.php");


if( isset($_SESSION['connex_active']) && Membre::estAdmin($_SESSION['connex_active']) ) {
	
	/**
	* Recuperation de l'id du membre anonyme
	*/	
	$id_anonyme = Membre::getIdFromPseudo("anonyme");
	
	/**
	* Recuperation de l'id de l'administateur
	*/
	$id_admin = Membre::getIdFromProfil("administrateur");
	
	/**
	*	Verification si l'id passer en get n'est pas id du membre anonyme
	*/
	if(($_GET['id'] != $id_anonyme)&&($_GET['id'] != $id_admin)) {
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