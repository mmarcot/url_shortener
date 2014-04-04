<?php
include("tools.php");

enteteHTML("Raccourcisseur d'URL");
enteteTitreHTML("Réduction URL");
?>

<form method="post" action="rac.php">
  URL : <input type="text" name="url_orig"
  value='<?php if(isset($_SESSION['url_orig'])) echo $_SESSION['url_orig'];?>'/>
  <br>
  <br> 
  
  <input type="submit" name="envoie" value="GENERER"/>
  <br>
  <br>
</form>

URL reduite :
<br>
<br> 
TEST
<br><br><a href='XXXXXX.php'>CONNEXION</a> 
<br><br><a href='XXXXXX.php'>INSCRIPTION</a> <br><br>


<?php 
finHTML();
?>




