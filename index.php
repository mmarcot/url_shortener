<?php
include("tools.php");
include("config.php");
enteteHTML("Raccourcisseur d'URL");
?>

<?php

	if(!empty($_SESSION['connex_active'])) {
	
		$stmt =$pdo->prepare("SELECT profil FROM membres where nom=:i");
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->bindParam(':i', $p);
		$p = $_SESSION['connex_active'];
		$stmt->execute();
		
		foreach($stmt as $val) {
		$p=$val->profil;
		}
	
		$nom = $_SESSION['connex_active'];
		
		echo "<p style='text-align:center;' >".$nom." est connecté "."(".$p.")"."</p>";
	}

?>

<h2 style='text-align:center;'>Réduction d'URL</h2>
<form method="post" action="rac.php">
  <table style="margin:auto; background:#EEEEEE; padding:5px;">
  <tr>
    <td>URL :</td>
    <td><input type="text" name="url_orig" value="<?php if(isset($_SESSION['url_orig'])) { echo $_SESSION['url_orig']; } ?>"></td>
  </tr>
  </table>

<?php
if(!empty($_SESSION['erreur'])){
  echo "<br>";
  echo "<div style='color:red; border:1px solid red; width:400px; margin:auto; text-align:center;'>";
  echo $_SESSION['erreur'];  
  echo "</div>";
  $_SESSION['erreur'] = "";
}
?>

  <p style="text-align:center;">
    <input type="submit" value="Générer &rarr;">
  </p>
</form>

<?php
// si l'utilisateur est connecté :
if( !empty($_SESSION['connex_active'] )) {
  echo <<<CONN
  <table style='margin:auto; background:#EEEEEE; padding:8px'>
  <tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>
  <tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>
  </table>
CONN;

}
else { // sinon il n'est pas connecté :
  echo <<<PACO
  <table style='margin:auto; background:#EEEEEE; padding:8px'>
  <tr><td><a style='text-align:center;' href='connexion.php'>Me connecter</a></td></tr>
  <tr><td><a style='text-align:center;' href='inscription.php'>M'inscrire</a></td></tr>
  </table>
PACO;
}

finHTML();
?>




