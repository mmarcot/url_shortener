<?php
include_once("tools.php");
include_once("config.php");

include_once("Url.php");
include_once("mes_liens.php");

enteteHTML("Suppr liens");
?>

<?php
	
	Url::supprimerUrl($_GET['id'])
	
?>

	

<?php 
finHTML();
?>
