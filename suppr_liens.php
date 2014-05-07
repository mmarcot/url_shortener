<?php
include_once("Url.php");
include_once("Membre.php");

// verifier que le lien appartient bien au pseudo connecté ou est admin :
if( Membre::estAdmin($_SESSION['connex_active']) || Membre::getIdFromPseudo($_SESSION['connex_active']) == Url::getAuthor($_GET['id']) )
	Url::supprimerUrl($_GET['id']);
	
header("Location: mes_liens.php");
?>
