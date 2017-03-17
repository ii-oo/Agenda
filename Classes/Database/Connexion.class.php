<?php
/**
 * @name Connexion.class.php Abstraction de classe de connexion à une base de données
 * @author webdev - 2016 - 2017
 * @package /Objet/Initiation/Classes/Database
 * @version 1.0
**/
abstract class Connexion {
	/**
	* @var string $host : Adresse du serveur de base de données
	**/
	protected $host;
	
	/**
	* @var int $port : Port d'écoute du serveur de base de données
	**/
	protected $port;
	
	/**
	* @var string $userName : Nom de l'utilisateur autorisé à se connecter au serveur de base de données
	**/
	protected $userName;
	
	/**
	* @var string $password : Mot de passe associé à l'utilisateur autorisé
	**/
	protected $password;
	
	/**
	* @var string $dbName : Nom de la base de données sur laquelle se connecter
	**/
	protected $dbName;
	
	/**
	* @var boolean $statut : Stocke l'état de la connexion à la base de données
	**/
	private $statut;
	
	/**
	* @var PDO $connexion : Instance de connexion PDO
	**/
	private $connexion;

	
	/**
	* public boolean getStatut(void)
	*	@return boolean : Retourne vers le monde extérieur la valeur de l'attribut $this->statut
	**/
	public function getStatut(){
		return $this->statut;
	}
	
	/**
	* void setStatut(boolean $statut)
	*	Permet de définir, à partir des classes filles l'attribut privé $statut
	**/
	protected function setStatut($statut){
		$this->statut = $statut;
	}
	
	protected function setConnexion($connexion){
		$this->connexion = $connexion;
	}
	
	public function getConnexion(){
		if($this->statut){
			return $this->connexion;
		}
	}
	
	public function isLocal(){
		if($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_NAME"] == "127.0.0.1"){
			return true;
		}
		return false;
	}
	
	/**
	* Définition d'une méthode abstraite, sans corps ({})
	*	pour obliger à coder cette méthode dans les classes filles
	**/
	abstract public function connect();
			
}