<?php
include_once("administration.php");
include_once("Modification.php");


		Modification::modifPseudo('23', 'bari');
		header("Location: administration.php");
	

?>
