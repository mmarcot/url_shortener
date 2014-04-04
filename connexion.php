<?php
include_once("tools.php");
include_once("config.php");

enteteHTML("Connexion");

echo <<<END
<h2 style="text-align:center;">Connexion</h2>
<form action="connex_res.php" method="post" accept-charset="utf-8">
  <table style="margin:auto; background:#EEEEEE; padding:5px;">
    <tr>
      <td>Pseudo :</td>
      <td><input type="text" name="pseudo_c" value=""></td>
    </tr>
    <tr>
      <td>Mot de passe :</td>
      <td><input type="password" name="pass_c" value=""></td>
    </tr>
  </table>

  <p style="text-align:center;">
    <input type="submit" value="Me connecter &rarr;">
  </p>
</form>
END;

if(!empty($_SESSION['erreur'])){
  echo "<div style='color:red; border:1px solid red; width:400px; margin:auto;'>";
  echo $_SESSION['erreur'];  
  echo "</div>";
  $_SESSION['erreur'] = "";
}

echo <<<END
<table style='margin:auto; background:#EEEEEE; padding:8px'>
<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>
<tr><td><a style='text-align:center;' href='inscription.php'>M'inscrire</a></td></tr>
</table>
END;

finHTML();
?>
