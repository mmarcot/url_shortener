<?php
include_once("Url.php");

//TODO verifier que le lien appartient bien au pseudo connecté

Url::supprimerUrl($_GET['id']);
header("Location: mes_liens.php");
?>
