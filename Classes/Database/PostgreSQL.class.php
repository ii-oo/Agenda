<?php
/**
* @name PostgreSQL.class.php Service de connexion PDO à une base PostgreSQL
**/
class PostgreSQL extends Connexion {
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
		$this->port = 5432;
		$this->userName = "user_db_pg";
		$this->password = "admin";
		$this->dbName = "base_pgsql";
		
		// Appeler la méthode privée pour calculer la chaîne de connexion
		$this->dsn = $this->setDSN();
	}

	/**
	* public boolean connect(void)
	*	Tente de se connecter à la base de données et retourne le statut de connexion
	*	@return boolean
	**/
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
		$dsn .= "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbName . ";user=" . $this->userName . ";password=" . $this->password;
		
		return $dsn;
	}
}
