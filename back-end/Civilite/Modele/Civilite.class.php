<?php
/**
* @name Civilite.class.php : Services de gestion de la table civilite
* @package /Objet/Classes/Database/Authentification
* @version 1.0
*	Cette classe a pour objectif de traiter les opérations sur la table civilites de la base de données
*	- Sélection,
*	- Insertion,
*	- Modification
*	- Suppression
*		(CRUD : Create Update Delete)
*		(ORM : Object Relational Mapper)
**/

require_once("../Classes/Database/dbConnect.class.php");
require_once("../Classes/Database/Modele.class.php");

class Civilite extends Modele{
	
	/**
	*	@var private string $libelle : Nom de la colonne qui contient le libellé de la civilité
	**/
	private $libelle;
	
	/**
	* public array $civilites : Stocke l'ensemble des données de la table civilites
	**/
	public $civilites;
	
	/**
	* public void __construct(void)
	*	Construit un objet de type civilite et définit les propriétés privées nécessaires
	**/
	public function __construct(){
		$this->tableName = "civilites"; // Nom de la table de la base de données
		
		$this->primaryKeyName = "civilite_id"; // Nom de la clé primaire de la table civilites
		
		$this->libelle = "libelle"; // Nom de la colonne dans la table de base de données
		
		$this->civilites = array(); // Initialise le tableau avec un tableau vide
		
	}

	/**
	 * public bool function save(array $donneesPostees)
	 * @param array $donneesPostees => copie du tableau interne $_POST
	 * @return boolean Vrai si l'opération s'est bien déroulée, faux sinon
	 **/
	public function save($donneesPostees){
		// Avant toute chose, vérifier s'il n'existe pas déjà une ligne dans la table avec ce libellé
		if($this->exists($donneesPostees["libelle"]) == false){
			if($donneesPostees["clePrimaire"] == ""){
				// Insertion demandée
				$requete = "INSERT INTO " . $this->tableName . " (" . $this->libelle . ") VALUES ('" . $donneesPostees["libelle"] . "');";
			} else {
				// Mise à jour demandée
				$requete = "UPDATE " . $this->tableName . " SET " . $this->libelle . " = '" . $donneesPostees["libelle"] . "'";
				$requete .= " WHERE " . $this->primaryKeyName . " = " . $donneesPostees["clePrimaire"] . ";";
			}
			// Reste à exécuter la requête elle-même
			$connexion = new dbConnect();
			$base = $connexion->getBase();
			if(!is_null($base)){
				$resultat = $base->exec($requete);
				if($resultat !== false){
					return true;
				}
			}
		}
		return false; // Tous les autres cas possibles
	}
	
	/**
	 * private boolean exists(string $libelle)
	 *	@param string $libelle => libellé à chercher dans la table courante
	 *	@return boolean : vrai s'il existe déjà une ligne avec ce libellé, faux sinon
	 **/
	private function exists($libelle){
		// Crée la requête SQL : Compte moi le nombre de ligne dans la table
		//	pour lequel la colonne libelle est égal à ce qui a été saisi par l'utilisateur
		$select = "SELECT COUNT(*) AS nb FROM " . $this->tableName;
		$select .= " WHERE " . $this->libelle . " = '" . $libelle . "';";
	
		// Connexion à la base de données
		$connexion = new dbConnect();
		$base = $connexion->getBase();
	
		if(!is_null($base)){
			$resultats = $base->query($select);
			if($resultats){
				$resultats->setFetchMode(PDO::FETCH_OBJ);
				$ligne = $resultats->fetch(); // Récupère dans $ligne la seule ligne de résultats
				// Vérifier la valeur de l'attribut "nb" retourné dans $ligne
				if($ligne->nb == 0){
					return false;
				}
			}
		}
		// Soit je n'ai pas pu me connecter à la base, soit ma requête a échoué, soit il existe déjà une ligne avec ce libellé dans la table
		return true; // Considérons que ça existe déjà
	}
	
	/**
	* public void select(void)
	*	Crée et exécute la requête de sélection de toutes les lignes de la table civilites
	*	Définit (set) le tableau $this->civilites
	**/
	public function select(){
		$select = "SELECT " . $this->primaryKeyName . "," .$this->libelle . " FROM " . $this->tableName . ";";
		
		// Instancie un objet de connexion à la base de données
		$connexion = new dbConnect();
		$base = $connexion->getBase(); // $base est un objet de type PDO
		
		if(!is_null($base)){
			$resultats = $base->query($select);
			if($resultats){ // Vérifie si la requête s'est exécutée correctement
				// Parcourir le jeu de résultats pour alimenter les données à traiter
				$resultats->setFetchMode(PDO::FETCH_OBJ);
				while($ligne = $resultats->fetch()){
					$this->civilites[] = array(
						"clePrimaire" => $ligne->{$this->primaryKeyName},
						"libelle" => $ligne->libelle
					);
				}
			}
			
		}
	}
	
	/**
	* public array selectById(int $primaryKeyValue)
	*	@param int $primaryKeyValue : Identifiant de la civilité courante
	*	@return array Tableau associatif avec l'ID de la civilité et le libellé
	**/
	public function selectById($primaryKeyValue){
		$select = "SELECT " . $this->primaryKeyName . "," . $this->libelle . " FROM " . $this->tableName;
		// Ajouter la contrainte sur civilite_id
		$select .= " WHERE " . $this->primaryKeyName . " = " . $primaryKeyValue . ";";
		
		// Instancie un objet de connexion à la base de données
		$connexion = new dbConnect();
		$base = $connexion->getBase(); // $base est un objet de type PDO
		
		if(!is_null($base)){
			$resultats = $base->query($select);
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			$ligne = $resultats->fetch();
			$laLigne = array(
				"clePrimaire" => $ligne->{$this->primaryKeyName},
				"libelle" => $ligne->libelle
			);
			return $laLigne;
		}
		
		return array();
	}
}