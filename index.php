<?php
include("tools.php");


enteteHTML("INDEX");
enteteTitreHTML("REDUCTION URL");
?>

	<form method="post" action="rac.php">
		URL : <input type="text" name="url"
		value='<?php if(isset($_GET['url'])) echo $_GET['url'];?>'/>
		<br>
		<br> 
		
		<input type="submit" name="envoie" value="GENERER"/>
		<br/>
		<br/>
		
		URL reduite :
		<br>
		<br> 
		TEST
	</form>

<br><br><a href='XXXXXX.php'>CONNEXION</a> 
<br><br><a href='XXXXXX.php'>INSCRIPTION</a> <br><br>


<?php 
finHTML();
?>




