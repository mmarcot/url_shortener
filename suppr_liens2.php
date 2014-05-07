<?php
include_once("Url.php");
include_once("Membre.php");

// verifier que le lien appartient bien au pseudo connecté ou est admin :
if( Membre::estAdmin($_SESSION['connex_active']) )
	Url::supprimerUrl($_GET['id']);

header("Location: administration.php");
?>
