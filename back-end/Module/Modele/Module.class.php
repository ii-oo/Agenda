<?php
/**
* @name Module.class.php : Services de gestion de la table module
* @package /Objet/Classes/Database/Authentification
* @version 1.0
*	Cette classe a pour objectif de traiter les opérations sur la table modules de la base de données
*	- Sélection,
*	- Insertion,
*	- Modification
*	- Suppression
*		(CRUD : Create Update Delete)
*		(ORM : Object Relational Mapper)
**/

require_once("../Classes/Database/dbConnect.class.php");
require_once("../Classes/Database/Modele.class.php");

class Module extends Modele{
	
	/**
	*	@var private string $libelle : Nom de la colonne qui contient le libellé de la civilité
	**/
	private $libelle;
	
	/**
	 * Nom de la colonne contenant l'url d'accès au module
	 * @var string
	 */
	private $url;
	
	/**
	* public array $modules : Stocke l'ensemble des données de la table modules
	**/
	public $modules;
	
	/**
	* public void __construct(void)
	*	Construit un objet de type Module et définit les propriétés privées nécessaires
	**/
	public function __construct(){
		$this->tableName = "modules"; // Nom de la table de la base de données
		
		$this->primaryKeyName = "module_id"; // Nom de la clé primaire de la table modules
		
		$this->libelle = "libelle"; // Nom de la colonne dans la table de base de données
		$this->url = "libelle_url";
		
		$this->modules = array(); // Initialise le tableau avec un tableau vide
		
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
				$requete = "INSERT INTO " . $this->tableName . " (" . $this->libelle . "," . $this->url . ") VALUES ('" . $donneesPostees["libelle"] . "','" . $donneesPostees["url"] . "');";
			} else {
				// Mise à jour demandée
				$requete = "UPDATE " . $this->tableName . " SET " . $this->libelle . " = '" . $donneesPostees["libelle"] . "',";
				$requete .= $this->url . "='" . $donneesPostees["url"] . "'";
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
		$select = "SELECT " . $this->primaryKeyName . "," . $this->libelle . "," . $this->url . " FROM " . $this->tableName . ";";
		
		// Instancie un objet de connexion à la base de données
		$connexion = new dbConnect();
		$base = $connexion->getBase(); // $base est un objet de type PDO
		
		if(!is_null($base)){
			$resultats = $base->query($select);
			if($resultats){ // Vérifie si la requête s'est exécutée correctement
				// Parcourir le jeu de résultats pour alimenter les données à traiter
				$resultats->setFetchMode(PDO::FETCH_OBJ);
				while($ligne = $resultats->fetch()){
					$this->modules[] = array(
						"clePrimaire" => $ligne->{$this->primaryKeyName},
						"libelle" => $ligne->{$this->libelle},
						"url" => $ligne->{$this->url}
					);
				}
			}
			
		}
	}
	
	/**
	* public array selectById(int $primaryKeyValue)
	*	@param int $primaryKeyValue : Identifiant du module courant
	*	@return array Tableau associatif avec l'ID du module, le libellé et l'url
	**/
	public function selectById($primaryKeyValue){
		$select = "SELECT " . $this->primaryKeyName . "," . $this->libelle . "," . $this->url . " FROM " . $this->tableName;
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
				"libelle" => $ligne->{$this->libelle},
				"url" => $ligne->{$this->url}
			);
			return $laLigne;
		}
		
		return array();
	}
}