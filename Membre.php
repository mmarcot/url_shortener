<?php
include_once("tools.php");
include_once("config.php");


class Membre {
  private $nom;
  private $prenom;
  private $email;
  private $pseudo;
  private $mdpCrypt;
  private $connecte;


  /*
   * Constructeur qui permet de créer un nouveau membre et de 
   * l'insérer dans la base de données
   */
  public function __construct($n, $pn, $mail, $pseu, $mdp_clair) {
    $this->nom = $n;
    $this->prenom = $pn;
    $this->email = $mail;
    $this->pseudo = $pseu;
    $this->mdpCrypt = crypt($mdp_clair, 'rl');
    $this->connecte = false;

    // insertion dans la base de donnée :
    $req_ins = $pdo->prepare("INSERT INTO membres(nom, prenom, pseudo, mail, mdp) VALUES(:nom, :pre, :pseu, :mail, :pwd);");
    $req_ins->bindParam(":pseu", $this->pseudo);
    $req_ins->bindParam(":pre", $this->prenom);
    $req_ins->bindParam(":nom", $this->nom);
    $req_ins->bindParam(":mail", $this->email);
    $req_ins->bindParam(":pwd", $this->mdpCrypt);
    $req_ins->execute();
  }

}

public function seConnecter($pwd){

 // on teste les entrees du formulaire pour voir si l'utilisateur et le mdp sont OK :
 
  $req = $pdo->prepare("SELECT pseudo, mdp FROM membres WHERE pseudo=:pseu;");
  $req->bindParam(":pseu", $_POST['pseudo_c']);
  $req->execute();
  $req->setFetchMode(PDO::FETCH_OBJ);
  $trouve = false;
  foreach( $req as $ligne ) {
    if( $ligne->mdp == $this->mdpCrypt ) {
      $trouve = true;
      header("Location: XXXXX.php"); //TODO changer la redirection
    }
  }
  if(!$trouve) {
    $_SESSION['erreur'] = "Utilisateur ou mot de passe incorrect";
    header("Location: connexion.php");
  }
}

public function seDeconnecter() {
	
	$this->connecter = false;
	
	session_destroy();
	header("Location: index.php");
	
}

public function estConnecter() {
	
	$this->connecter = true;
	
}

public function getPseudo() {

	return $this->pseudo;
	
}

public function initUrl() {

	getURL();

}

public function getUrl() {

}

?>
