<?php
include_once("tools.php");
include_once("config.php");

enteteHTML("Formulaire d'inscription");
?>
<h2 style="text-align:center;">Inscription</h2>
<form action="inscription_res.php" method="post" accept-charset="utf-8">
  <table style="margin:auto; background:#EEEEEE; padding:5px;">
    <tr>
      <td>Pseudo :</td>
      <td><input type="text" name="pseudo" value="<?php if(isset($_SESSION['pseudo'])) { echo $_SESSION['pseudo']; } ?>"></td>
    </tr>
    <tr>
      <td>Mot de passe :</td>
      <td><input type="password" name="pass" value=""></td>
    </tr>
    <tr>
      <td>Nom :</td>
      <td><input type="text" name="nom" value="<?php if(isset($_SESSION['nom'])) { echo $_SESSION['nom']; } ?>"></td>
    </tr>  
    <tr>
      <td>Prénom :</td>
      <td><input type="text" name="prenom" value="<?php if(isset($_SESSION['prenom'])) { echo $_SESSION['prenom']; } ?>"></td>
    </tr>  
    <tr>
      <td>E-Mail :</td>
      <td><input type="text" name="mail" value="<?php if(isset($_SESSION['mail'])) { echo $_SESSION['mail']; } ?>"></td>
    </tr>  
  </table>
  <p style="text-align:center;">
    <input type="submit" value="Continuer &rarr;">
  </p>
</form>

<?php
if(!empty($_SESSION['info'])) {
  echo "<div style='color:green; border:1px solid green; width:400px; margin:auto;'>";
  echo $_SESSION['info'];  
  echo "</div>";
  $_SESSION['info'] = "";
}
if(!empty($_SESSION['erreur'])){
  echo "<div style='color:red; border:1px solid red; width:400px; margin:auto;'>";
  echo $_SESSION['erreur'];  
  echo "</div>";
  $_SESSION['erreur'] = "";
}

echo <<<END
<table style='margin:auto; background:#EEEEEE; padding:8px'>
<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>
<tr><td><a style='text-align:center;' href='connexion.php'>Me connecter</a></td></tr>
</table>
END;

finHTML();
?>

