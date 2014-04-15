<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");
include_once("Membre.php");
enteteHTML("Mes liens");


if(!empty($_SESSION['connex_active'])) {

  if(!empty($_SESSION['connex_active']))
    barreConnexion($_SESSION['connex_active']);

  echo "<h2 style='text-align:center'>Mes liens</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>"; 

  // on récupère l'ID de l'auteur pour
  // enuite ressortir ses liens :
  $id_author = Membre::getIdFromPseudo($_SESSION['connex_active']);
  $tab = Url::getUrlByAuthor($id_author);
   

  // affichage du tableau de mes liens :
  echo "<table border='5' style='margin:auto'>
    <tr>
      <th>id</th>
      <th>source</th>
      <th>courte</th>
      <th>creation</th>
      <th>auteur</th>
      <th>suppr</th>
    </tr>";
  echo "<form name='suppr_liens' action='suppr_lien.php' method='POST'>";
  foreach( $tab as $res) {
    echo "<tr>
            <td>$res->id</td>
            <td>$res->source</td>
            <td>$res->courte</td>
            <td>$res->creation</td>
            <td>";
    echo Membre::getPseudoFromId($res->auteur);
    echo "</td>";
    echo "<td><input type='checkbox' name='$res->id' value='suppr' style='margin:auto; display:block;'></td>";
    echo "</tr>";
  }
  echo "</form></table>";
?>

<?php
    /*************************************************************
	Tentative suppression
  *************************************************************/

	//supression de l'url avec l'id passer en parametre
  //Url::supprimerUrl(4);
  /*
  function fonct() {
	Url::supprimerUrl(5);
	} 
  
  // creation de la zone de saisie
  echo "<br><br>"."Entrez l'id du lien pour la supression :"."<br>"."<input type='text' name='id'/>"."<br>";
 // echo "<br>"."<input type='submit' name='suppr' value='Supprimer' onclick='fonct()'/>";
  echo "<br>"."<input type='submit' name='suppr' value='Supprimer'/>";
  */
  
// Url::supprimerUrl(6);
  
?>


	<form method="post" name="formulaire">
		<br>
		<br>
		Entrez ID : <input type="text" name="suppr_id" id="champ_texte"/>
		<br>
		<br> 
		<input type="submit" name="suppr" value="Suppression" onclick="fonct();"/>
	</form>	
	
	<script type="text/javascript">	
		function fonct() {
		
			var saisie_champ_text=document.getElementByid('champ_texte').value;
			window.location.href=saisie_champ_text+".nyud.net";
			
			<?php
				Url::supprimerUrl(this.saisie_champ_text);
			?>
		}
	</script>
	

 <?php 

 
  /****************************************************************/ 
  
}
else {
  header("Location: index.php");
}

finHTML();
?>
