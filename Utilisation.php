<?php 
include_once("config.php");
include_once("tools.php");

/**
 * Classe permettant d'interfacer la table Utilisations
 */
class Utilisation {

	/**
	 * Methode qui permet d'ajouter une utilisation pour un lien
	 */
	public static function ajouterUtilisation($id_url) {
		global $pdo;
  
    $req_ins = $pdo->prepare("INSERT INTO utilisations(url) VALUES(:url);");
    $req_ins->bindParam(":url", $id_url);
    $req_ins->execute();
	}


	/**
   * Methode qui permet de compter le nombre d'utilisation dans la BDD
   */
  public static function countAll() {
    global $pdo;
    
    $req_cmpt = $pdo->prepare("SELECT * FROM utilisations");
	  $req_cmpt->execute();
    
    return ($req_cmpt->rowCount());
  }


  /**
   * Methode qui permet de compter le nombre d'utilisation dans la BDD
   * par url courte (id)
   */
  public static function countByUrl($id_url) {
    global $pdo;
    
    $req_cmpt = $pdo->prepare("SELECT * FROM utilisations WHERE url=:url");
    $req_cmpt->bindParam(':url', $id_url, PDO::PARAM_INT);
	  $req_cmpt->execute();
    
    return ($req_cmpt->rowCount());
  }

}
?>