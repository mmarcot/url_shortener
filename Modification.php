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
	public static function modifPseudo($id, $NPseudo) {
		global $pdo;
	
		$req_modif_pseudo = $pdo->prepare("UPDATE `membres` SET `pseudo`=:NPseudo WHERE id=:id");
		$req_modif_pseudo->bindParam(':NPseudo', $NPseudo);
		$req_modif_pseudo->execute();
		$req_modif_pseudo->setFetchMode(PDO::FETCH_OBJ);
	}
	
	public static function modifNom($id, $NNom) {
		global $pdo;
	
		$req_modif_nom = $pdo->prepare("UPDATE `membres` SET `nom`=:NNom WHERE id=:id");
		$req_modif_nom->bindParam(':NNom', $NNom);
		$req_modif_nom->execute();
		$req_modif_nom->setFetchMode(PDO::FETCH_OBJ)
	
	}
	
	public static function modifPrenom($id, $NPrenom) {
		global $pdo;
	
		$req_modif_prenom = $pdo->prepare("UPDATE `membres` SET `prenom`=:NPrenom WHERE id=:id");
		$req_modif_prenom->bindParam(':NPrenom', $NPrenom);
		$req_modif_prenom->execute();
		$req_modif_prenom->setFetchMode(PDO::FETCH_OBJ)
	}
	
	public static function modifEmail($id, $NEmail) {
		global $pdo;
	
		$req_modif_email = $pdo->prepare("UPDATE `membres` SET `email`=:NEmail WHERE id=:id");
		$req_modif_email->bindParam(':$NEmail', $NEmail);
		$req_modif_email->execute();
		$req_modif_email->setFetchMode(PDO::FETCH_OBJ)
	}
	
}

?>














