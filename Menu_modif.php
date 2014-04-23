<?php
include_once("Modification.php");
	
	echo "
	<h2 style='text-align:center;'>MODIFICATION</h2>
	<form action='Menu_modif.php' method='post' accept-charset='utf-8'>
	  <table style='margin:auto; background:#EEEEEE; padding:5px;'>
		<tr>
		  <td>ID :</td>
		  <td><input type='text' name='id_m' value='${_GET['id']}'></td>
		</tr>
		<tr>
		  <td>Pseudo :</td>
		  <td><input type='text' name='pseudo_m' value=''></td>
		</tr>
		<tr>
		  <td>Nom :</td>
		  <td><input type='text' name='nom_m' value=''></td>
		</tr>
		<tr>
		  <td>Prenom :</td>
		  <td><input type='text' name='prenom_m' value=''></td>
		</tr>
		<tr>
		  <td>Email :</td>
		  <td><input type='text' name='mail_m' value=''></td>
		</tr>
		
	  <p style='text-align:center;'>
		<input type='submit' value='Modifier &rarr;'>
	  </p>
	</form>
	
	<p style='text-align:center;'>
	<select name = 'profil'>
	<option>membre</option>
	<option>administrateur</option>
	</select>";
	
	echo"<p style='text-align:center;'>
	<a href='administration.php'>retour</a>";

	if((!empty($_POST['id_m']))&&(!empty($_POST['pseudo_m']))) {
		Modification::modifPseudo($_POST['id_m'], $_POST['pseudo_m']);
		}
	if((!empty($_POST['id_m']))&&(!empty($_POST['nom_m']))) {
		Modification::modifNom($_POST['id_m'], $_POST['nom_m']);
	}
	if((!empty($_POST['id_m']))&&(!empty($_POST['prenom_m']))) {
		Modification::modifPrenom($_POST['id_m'], $_POST['prenom_m']);
	}
	if((!empty($_POST['id_m']))&&(!empty($_POST['mail_m']))) {
		Modification::modifEmail($_POST['id_m'], $_POST['mail_m']);
	}
	if((!empty($_POST['id_m']))&&(!empty($_POST['profil_m']))) {
		Modification::modifProfil($_POST['id_m'], $_POST['profil_m']);
	}
	
	//header("Location: administration.php");
	

?>
