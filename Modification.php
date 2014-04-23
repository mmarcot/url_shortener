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
	public static function modifPseudo($id, $NPseudo) {
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
	public static function modifEmail($id, $NEmail) {
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

	
	/**
	 * Methode qui permet de récupérer le pseudo à partir de l'id
	 */	
	public static function getPseudoFromId($id) {
		global $pdo;
		$pseudo = "";
		$req_recup_pseudo = $pdo->prepare("SELECT pseudo FROM `membres` WHERE id=:rid");
		$req_recup_pseudo->bindParam(':rid', $id, PDO::PARAM_INT);
		$req_recup_pseudo->execute();
		$req_recup_pseudo->setFetchMode(PDO::FETCH_OBJ);
    
		foreach($req_recup_pseudo as $ligne) {
			$pseudo = $ligne->pseudo;
		}
		return $pseudo;
	}
	

	/**
	 * Methode qui permet de récupérer le nom à partir de l'id
	 */
	public static function getNomFromId($id) {
		global $pdo;
		$nom = "";
		$req_recup_nom = $pdo->prepare("SELECT nom FROM `membres` WHERE id=:rid");
		$req_recup_nom->bindParam(':rid', $id, PDO::PARAM_INT);
		$req_recup_nom->execute();
		$req_recup_nom->setFetchMode(PDO::FETCH_OBJ);
    
		foreach($req_recup_nom as $ligne) {
			$nom = $ligne->nom;
		}
		return $nom;
	}


	/**
	 * Methode qui permet de récupérer le prénom à partir de l'id
	 */
	public static function getPrenomFromId($id) {
		global $pdo;
		$prenom = "";
		$req_recup_prenom = $pdo->prepare("SELECT prenom FROM `membres` WHERE id=:rid");
		$req_recup_prenom->bindParam(':rid', $id, PDO::PARAM_INT);
		$req_recup_prenom->execute();
		$req_recup_prenom->setFetchMode(PDO::FETCH_OBJ);
		
		foreach($req_recup_prenom as $ligne) {
			$prenom = $ligne->prenom;
		}
		return $prenom;
	}



	/**
	 * Methode qui permet de récupérer le mail à partir de l'id
	 */
	public static function getEmailFromId($id) {
		global $pdo;
		$mail = "";
		$req_recup_mail = $pdo->prepare("SELECT mail FROM `membres` WHERE id=:rid");
		$req_recup_mail->bindParam(':rid', $id, PDO::PARAM_INT);
		$req_recup_mail->execute();
		$req_recup_mail->setFetchMode(PDO::FETCH_OBJ);
    
		foreach($req_recup_mail as $ligne) {
			$mail = $ligne->mail;
		}
		return $mail;
	}


	/**
	 * Methode qui permet de récupérer le profil à partir de l'id
	 */
	public static function getProfilFromId($id) {
		global $pdo;
		$profil = "";
		$req_recup_profil = $pdo->prepare("SELECT profil FROM `membres` WHERE id=:rid");
		$req_recup_profil->bindParam(':rid', $id, PDO::PARAM_INT);
		$req_recup_profil->execute();
		$req_recup_profil->setFetchMode(PDO::FETCH_OBJ);
    
		foreach($req_recup_profil as $ligne) {
			$profil = $ligne->profil;
		}
		return $profil;
	}
	
}

?>














