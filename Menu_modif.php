<?php
include_once("Modification.php");
	
$pseudo = Modification::getPseudoFromId($_GET['id']);
$nom = Modification::getNomFromId($_GET['id']);
$prenom = Modification::getPrenomFromId($_GET['id']);
$email = Modification::getEmailFromId($_GET['id']);
$profil = Modification::getProfilFromId($_GET['id']);

echo <<<FORM
<h2 style='text-align:center;'>MODIFICATION</h2>
<form action='administration.php' method='post' accept-charset='utf-8'>
  <table style='margin:auto; background:#EEEEEE; padding:5px;'>
	<tr>
	  <td>ID :</td>
	  <td><input type='text' name='id_m' value='${_GET['id']}'></td>
	</tr>
	<tr>
	  <td>Pseudo :</td>
	  <td><input type='text' name='pseudo_m' value='$pseudo'></td>
	</tr>
	<tr>
	  <td>Nom :</td>
	  <td><input type='text' name='nom_m' value='$nom'></td>
	</tr>
	<tr>
	  <td>Prenom :</td>
	  <td><input type='text' name='prenom_m' value='$prenom'></td>
	</tr>
	<tr>
	  <td>Email :</td>
	  <td><input type='text' name='mail_m' value='$email'></td>
	</tr>
	<tr>
		<td>Profil :</td>
		<td>
		<input type = 'radio' name = 'choix' value = 'administrateur'/>
		Administrateur 
		
		<input type = 'radio' name = 'choix' value = 'membre'/>
		Membre											
		</td>
	</tr>
</table>

<p style='text-align:center;'>
	<input type='submit' value='Modifier &rarr;'>
  </p>
</form>
FORM;

echo"<p style='text-align:center;'>
	<a href='administration.php'>retour</a></p>";

?>
