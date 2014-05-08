<?php
include_once("config.php");
include_once("tools.php");


/**
 * Classe qui regroupe un ensemble de methodes statiques
 * pour la gestion des modifications membre 
 */
class Modification {

	/**
	 * Methode qui permet de modifier le pseudo d'un membre dans la BDD
	 */
	public static function modifPseudo($id, $NPseudo) { //TODO verifier existe deja
		global $pdo;
	
		$req_modif_pseudo = $pdo->prepare("UPDATE `membres` SET `pseudo`=:NPseudo WHERE id=:id");
		$req_modif_pseudo->bindParam(':NPseudo', $NPseudo);
		$req_modif_pseudo->bindParam(':id', $id);
		$req_modif_pseudo->execute();
		$req_modif_pseudo->setFetchMode(PDO::FETCH_OBJ);
	}
	

	/**
	 * Methode qui permet de modifier le nom d'un membre dans la BDD
	 */
	public static function modifNom($id, $NNom) {
		global $pdo;
	
		$req_modif_nom = $pdo->prepare("UPDATE `membres` SET `nom`=:NNom WHERE id=:id");
		$req_modif_nom->bindParam(':NNom', $NNom);
		$req_modif_nom->bindParam(':id', $id);
		$req_modif_nom->execute();
		$req_modif_nom->setFetchMode(PDO::FETCH_OBJ);
	
	}
	

	/**
	 * Methode qui permet de modifier le prenom d'un membre dans la BDD
	 */
	public static function modifPrenom($id, $NPrenom) {
		global $pdo;
	
		$req_modif_prenom = $pdo->prepare("UPDATE `membres` SET `prenom`=:NPrenom WHERE id=:id");
		$req_modif_prenom->bindParam(':NPrenom', $NPrenom);
		$req_modif_prenom->bindParam(':id', $id);
		$req_modif_prenom->execute();
		$req_modif_prenom->setFetchMode(PDO::FETCH_OBJ);
	}


	/**
	 * Methode qui permet de modifier le mail d'un membre dans la BDD
	 */
	public static function modifEmail($id, $NEmail) { //TODO verifier existe deja
		global $pdo;
	
		$req_modif_email = $pdo->prepare("UPDATE `membres` SET `mail`=:NEmail WHERE id=:id");
		$req_modif_email->bindParam(':NEmail', $NEmail);
		$req_modif_email->bindParam(':id', $id);
		$req_modif_email->execute();
		$req_modif_email->setFetchMode(PDO::FETCH_OBJ);
	}
	

	/**
	 * Methode qui permet de modifier le profil(membre/admin) d'un membre dans la BDD
	 */
	public static function modifProfil($id, $NProfil) {
		global $pdo;
	
		$req_modif_profil = $pdo->prepare("UPDATE `membres` SET `profil`=:NProfil WHERE id=:id");
		$req_modif_profil->bindParam(':NProfil', $NProfil);
		$req_modif_profil->bindParam(':id', $id);
		$req_modif_profil->execute();
		$req_modif_profil->setFetchMode(PDO::FETCH_OBJ);
	}

	
	
////////////////////////////////////////////////////////////////////////////////////////////////////////
// MODIFICATION DES LIENS
////////////////////////////////////////////////////////////////////////////////////////////////////////
	  

  
  	/**
	 * Methode qui permet de modifier l'url source
	 */
	public static function modifSource($id, $NSource) { 
		global $pdo;
	
		$req_modif_source = $pdo->prepare("UPDATE `urls` SET `source`=:NSource WHERE id=:id");
		$req_modif_source->bindParam(':NSource', $NSource);
		$req_modif_source->bindParam(':id', $id);
		$req_modif_source->execute();
		$req_modif_source->setFetchMode(PDO::FETCH_OBJ);
	}
	
	  	/**
	 * Methode qui permet de modifier l'url courte
	 */
	public static function modifCourte($id, $NCourte) { //TODO verifier si l'url courte n'existe pas deja
		global $pdo;
	
		$req_modif_source = $pdo->prepare("UPDATE `urls` SET `courte`=:NCourte WHERE id=:id");
		$req_modif_source->bindParam(':NCourte', $NCourte);
		$req_modif_source->bindParam(':id', $id);
		$req_modif_source->execute();
		$req_modif_source->setFetchMode(PDO::FETCH_OBJ);
	}
}

?>














