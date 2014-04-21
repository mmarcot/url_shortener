<?php
include_once("administration.php");
include_once("Modification.php");

//TODO verifier que le lien appartient bien au pseudo connecté

Modification::modifPseudo('23', 'modif');
header("Location: administration.php");
?>
