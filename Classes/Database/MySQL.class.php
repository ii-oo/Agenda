<?php
/**
 * @name MySQL.class.php Définition d'une connexion à une base de données mySQL
 * @author webdev 2016 - 2017
 * @package /Objet/Initiation/Classes/Database
 * @version 1.0 Extension de la classe Connexion
 * @see Connexion.class.php
**/
class MySQL extends Connexion {
	
	/**
	* @var string $message : Stocke l'éventuelle erreur de connexion à la base de données
	**/
	private $message;
	
	/**
	* Constructeur de l'instance d'une connexion mySQL
	* Définit les valeurs nécessaires pour se connecter
	**/
	public function __construct($host=null, $port=null, $userName=null, $password=null, $dbName=null){
		// Définit les paramètres de connexion à ma base de données
		$this->host = is_null($host) ? dbConfig::$host : $host;
		$this->port = is_null($port) ? dbConfig::$port : $port;
		$this->userName = is_null($userName) ? dbConfig::getUser() : $userName;
		$this->password = is_null($password) ? dbConfig::getPassword() : $password;
		$this->dbName = is_null($dbName) ? dbConfig::getDbName() : $dbName;
		
		//$this->connect();
	}
	
	public function setPort($port){
		$this->port = $port;
	}
	
	/**
	* public boolean connect(void)
	*	Tente de se connecter à la base de données et retourne le statut de connexion
	*	@return boolean
	**/
	public function connect(){
		$options = array();
		
		try{
			$connexion = new PDO($this->creerDSN(), $this->userName, $this->password, $options);
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
	private function creerDSN(){
		// Retourne la chaîne de caractère permettant la connexion mySQL
		return "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbName;

	}
	
	private function getDSN(){
		return $this->setDSN();
	}
}