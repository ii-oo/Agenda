<?php
/**
* @name dbConnect.class.php : service de connexion à une base de données
*	Design Pattern : Class Factory
**/

/**
* Requiert le fichier qui contient les constantes d'informations de connexion
**/
if(file_exists("../../_const/dbConfig.class.php"))
	require_once("../../_const/dbConfig.class.php");
else
	require_once("../../../_const/dbConfig.class.php");

	
if(file_exists("../../Classes/Database/Connexion.class.php"))
	require_once("../../Classes/Database/Connexion.class.php");
else
	require_once("../../../Classes/Database/Connexion.class.php");
	
if(file_exists("../../Classes/Database/MySQL.class.php"))
	require_once("../../Classes/Database/MySQL.class.php");
else
	require_once("../../../Classes/Database/MySQL.class.php");
	
//require_once("../../Classes/Database/PostgreSQL.class.php");
//require_once("../../Classes/Database/Oracle.class.php");

class dbConnect{
	/**
	* private mixed $base : Instance de connexion à une base de données ou faux, si la connexion a échoué
	**/
	private $base;
	
	
	public function __construct(){
		
		
		$connecteur = dbConfig::$sgbd; // => MySQL
		
		$connexion = new $connecteur();
		$connexion->connect();
		
		$this->base = $connexion->getConnexion();
	}
	
	/**
	* public mixed getBase(void)
	*	@return mixed : Instance de connexion à la base de données ou faux
	**/
	public function getBase(){
		return $this->base;
	}
}
