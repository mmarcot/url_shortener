<?php
include_once("administration.php");
include_once("Modification.php");

	if((!empty($_POST['id_m']))&&(!empty($_POST['pseudo_m']))) {
		Modification::modifPseudo($_POST['id_m'], $_POST['pseudo_m']);
		}
	if((!empty($_POST['id_m']))&&(!empty($_POST['nom_m']))) {
		Modification::modifNom($_POST['id_m'], $_POST['nom_m']);
	}
	if((!empty($_POST['id_m']))&&(!empty($_POST['prenom_m']))) {
		Modification::modifPrenom($_POST['id_m'], $_POST['prenom_m']);
	}
	if((!empty($_POST['id_m']))&&(!empty($_POST['email_m']))) {
		Modification::modifEmail($_POST['id_m'], $_POST['email_m']);
	}
	if((!empty($_POST['id_m']))&&(!empty($_POST['profil_m']))) {
		Modification::modifProfil($_POST['id_m'], $_POST['profil_m']);
	}
	
	header("Location: administration.php");
	

?>
