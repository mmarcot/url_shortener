<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");

enteteHTML("Votre URL raccourcis !");

$_SESSION['erreur'] = "";

if(empty($_POST['url_orig'])) {
  $_SESSION['erreur'] .= "Veuillez entrer un URL";
  header("Location: index.php");
}

if(!empty($_SESSION['connex_active']))
  barreConnexion($_SESSION['connex_active']);
?>

<h2 style='text-align:center;'>Réduction d'URL</h2>
<form method="post" action="">
  <table style="margin:auto; background:#EEEEEE; padding:5px;">
  <tr>
    <td>URL :</td>
    <td><input type="text" name="url_short" value="<?php if(isset($_POST['url_orig'])) { echo Url::genererUrlCourt($_POST['url_orig']); } ?>"></td>
  </tr>
  </table>
</form>
<br>

<?php
echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
if( !empty($_SESSION['connex_active'])) {
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
}
else {
  echo "<tr><td><a style='text-align:center;' href='connexion.php'>Me connecter</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='inscription.php'>M'inscrire</a></td></tr>";
}
echo "</table>";

finHTML();
?>





