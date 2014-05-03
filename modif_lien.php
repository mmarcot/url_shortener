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
	  <td>URL cible :</td>
	  <td><input type='text' name='cible_m' value='$pseudo'></td>
	</tr>
	<tr>
	  <td>URL courte :</td>
	  <td><input type='text' name='courte_m' value='$nom'></td>
	</tr>
DEB_FORM;

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
	<a href='administration.php'>Retour</a></p>";

finHTML();
?>
