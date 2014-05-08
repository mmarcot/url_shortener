<?php
include_once("Modification.php");
include_once("Membre.php");
include_once("Url.php");
include_once("tools.php");


// verifier que le lien appartient bien au pseudo connecté ou est admin :
if( Membre::estAdmin($_SESSION['connex_active']) || Membre::getIdFromPseudo($_SESSION['connex_active']) == Url::getAuthor($_GET['id']) ) {
	enteteHTML("Modification");

	// on cherche la page de provenance pour savoir ou rediriger :
	$page_provenance = $_SERVER['HTTP_REFERER'];
	if( strpos($page_provenance, "administration.php") )
		$redir = "administration.php";
	else $redir = "mes_liens.php";

	// affichage de la barre de connexion :
	if(!empty($_SESSION['connex_active']))
	  barreConnexion($_SESSION['connex_active']);

	// on récupère les info originales :
	$source = Url::getCibleById($_GET['id']);
	$courte = Url::getCourteById($_GET['id']);

	echo <<<FORM
	<h2 style='text-align:center;'>Modification</h2>
	<form action='${redir}' method='post' accept-charset='utf-8'>
	  <table style='margin:auto; background:#EEEEEE; padding:5px;'>
		<tr>
		  <td>ID :</td>
		  <td><input type='text' name='id_m' value='${_GET['id']}'></td>
		</tr>
		<tr>
		  <td>URL cible :</td>
		  <td><input type='text' name='source_m' value='$source'></td>
		</tr>
		<tr>
		  <td>URL courte :</td>
		  <td><input type='text' name='courte_m' value='$courte'></td>
		</tr>
	</table>

	<p style='text-align:center;'>
		<input type='submit' value='Modifier &rarr;'>
	  </p>
	</form>
FORM;


	echo"<p style='text-align:center;'>
		<a href='${redir}'>Retour</a></p>";

	finHTML();
}
else header("Location: index.php");
?>
