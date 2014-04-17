<?php
include_once("Url.php");

//TODO verifier qui le lien appartient bien au pseudo connecté

Url::supprimerUrl($_GET['id']);
header("Location: administration.php");
?>
