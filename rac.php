<?php
include("tools.php");
//include("config.php");

enteteHTML("Votre URL raccourcis !");

$_SESSION['erreur'] = "";

if(empty($_POST['url_orig'])) {
  $_SESSION['erreur'] .= "Veuillez entrer un URL";
  header("Location: index.php");
}
?>

<h2 style='text-align:center;'>Réduction d'URL</h2>
<form method="post" action="">
  <table style="margin:auto; background:#EEEEEE; padding:5px;">
  <tr>
    <td>URL :</td>
    <td><input type="text" name="url_short" value="<?php if(isset($_POST['url_orig'])) { echo $_POST['url_orig']; } ?>"></td>
  </tr>
  </table>
</form>
<br>
<table style='margin:auto; background:#EEEEEE; padding:8px'>
<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>
<tr><td><a style='text-align:center;' href='connexion.php'>Me connecter</a></td></tr>
<tr><td><a style='text-align:center;' href='inscription.php'>M'inscrire</a></td></tr>
</table>

<?php
finHTML();
?>
