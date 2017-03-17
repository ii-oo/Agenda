<?php
/**
* @name dbConfig.class.php Définit les attributs statiques de connexion à une base de données
**/
class dbConfig {
	/**
	* @var public static string $sgbd : Type du serveur de base de données
	**/
	public static $sgbd = "MySQL";
	/**
	* @var public static string $host : Adresse du serveur de bases de données
	**/
	public static $host = "127.0.0.1";
	
	/**
	* @var public static int $port : Port d'écoute du serveur de bases de données
	**/
	public static $port = 3306;
	
	/**
	* @var private static string $user : Nom de l'utilisateur de la base de données
	**/
	private static $user = "root";
	
	/**
	* @var private static string $password : Mot de passe associé à l'utilisateur de base de données
	**/
	private static $password = "";
	
	/**
	* @var private static string $dbName : Nom de la base de données sur laquelle se connecter
	**/
	private static $dbName = "authentification";
	
	public static function getUser(){
		return self::$user;
	}
	
	public static function getPassword(){
		return self::$password;
	}
	
	public static function getDbName(){
		return self::$dbName;
	}
}