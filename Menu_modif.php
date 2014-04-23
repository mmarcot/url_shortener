<?php
include_once("Modification.php");
include_once("tools.php");

enteteHTML("Modification");

// affichage de la barre de connexion :
if(!empty($_SESSION['connex_active']))
  barreConnexion($_SESSION['connex_active']);
	
// on récupère les info originales :
$pseudo = Modification::getPseudoFromId($_GET['id']);
$nom = Modification::getNomFromId($_GET['id']);
$prenom = Modification::getPrenomFromId($_GET['id']);
$email = Modification::getEmailFromId($_GET['id']);
$profil = Modification::getProfilFromId($_GET['id']);

echo <<<DEB_FORM
<h2 style='text-align:center;'>Modification</h2>
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
DEB_FORM;

// précochage du radio-button correspondant au profil :
if( $profil == 'administrateur' )
	echo "<input checked type='radio' name='profil_m' id='adm' value='administrateur'/>
		<label for='adm'>Administrateur</label> 
		<input type = 'radio' name = 'profil_m' id='memb' value = 'membre'/>
		<label for='memb'>Membre</label>";
else {
	echo "<input type='radio' name='profil_m' id='adm' value='administrateur'/>
		<label for='adm'>Administrateur</label> 
		<input checked type = 'radio' name = 'profil_m' id='memb' value = 'membre'/>
		<label for='memb'>Membre</label>";
}

echo <<<FIN_FORM
		</td>
	</tr>
</table>

<p style='text-align:center;'>
	<input type='submit' value='Modifier &rarr;'>
  </p>
</form>
FIN_FORM;


echo"<p style='text-align:center;'>
	<a href='administration.php'>retour</a></p>";

finHTML();
?>
