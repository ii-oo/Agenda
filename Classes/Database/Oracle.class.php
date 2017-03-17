<?php
/**
* @name Oracle.class.php
**/
class Oracle extends Connexion {
		/**
	* @var string $dsn : conserve la chaîne de connexion à la base de données
	**/
	private $dsn;
	
	/**
	* @var string $message : Stocke l'éventuelle erreur de connexion à la base de données
	**/
	private $message;

	/**
	* Constructeur de l'instance d'une connexion mySQL
	* Définit les valeurs nécessaires pour se connecter
	**/
	public function __construct(){
		// Définit les paramètres de connexion à ma base de données
		$this->host = "127.0.0.1";
		$this->port = 5555;
		$this->userName = "user_db_oracle";
		$this->password = "oracle";
		$this->dbName = "base_oracle";
		
		// Appeler la méthode privée pour calculer la chaîne de connexion
		$this->dsn = $this->setDSN();
	}
	
	public function connect(){
		try{
			$connexion = new PDO($this->dsn);
		}
		catch(Exception $e){
			$this->message = $e->getMessage() . " [" . $e->getCode() . "]";
			$this->setStatut(false);
			return false;
		}
		
		$this->setStatut(true);
		$this->setConnexion($connexion);
		return true;
	}
	
	/**
	* private string setDSN(void)
	*	@return string Chaîne de connexion à la base de données
	**/
	private function setDSN(){
		$dsn = "";
		
		// Création de la chaîne "dsn" de connexion à la base de données mySQL
		$dsn .= "oracle:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbName . ";user=" . $this->userName . ";password=" . $this->password;
		
		return $dsn;
	}
}