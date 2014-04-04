<?php
include("tools.php");
//include("config.php");

enteteHTML("racourci");
enteteTitreHTML("racourci");
?>

<?php

$url = $_POST['url'];

echo $url;

if(isset($url)){
	if(!empty($url)){
		$_SESSION['url'] = 'Champ url vide';
	}
	else {
	
		if(empty($url)) {
			$_SESSION['url'] = 'Champ url vide';
		}
		header("Location: index.php?url=$url");
	}
}
else {
	header("Location: index.php?url=$url");
}





?>


<?php 
//session_destroy();
finHTML();
?>