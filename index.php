<?php
include("tools.php");

enteteHTML("Raccourcisseur d'URL");
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

<table style='margin:auto; background:#EEEEEE; padding:8px'>
<tr><td><a style='text-align:center;' href='connexion.php'>Me connecter</a></td></tr>
<tr><td><a style='text-align:center;' href='inscription.php'>M'inscrire</a></td></tr>
</table>

<?php
finHTML();
?>




