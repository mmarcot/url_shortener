<?php
include_once("config.php");
include_once("tools.php");

/**
 * Classe qui regroupe un ensemble de methodes statiques
 * pour la gestion des membres 
 */
class Modification {

	///////////////////////////////////////////////////////////////////////
	// MODIFICATION														///
	///////////////////////////////////////////////////////////////////////
	public static function modifPseudo($NPseudo) {
		global $pdo;
	
		$req_modif_pseudo = $pdo->prepare("UPDATE `membres` SET `pseudo`=:NPseudo WHERE id=:id");
		$req_modif_pseudo->bindParam(':NPseudo', $NPseudo);
		$req_modif_pseudo->execute();
		$req_modif_pseudo->setFetchMode(PDO::FETCH_OBJ);
	}
	
	public static function modifNom($id) {
	}
	
	public static function modifPrenom($id) {
	}
	
	public static function modifEmail($id) {
	}
	
	public static function modifProfil($id) {
	}
}

?>














