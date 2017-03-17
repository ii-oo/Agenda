<?php
/**
 * @name Modele.class.php Abstraction de modèle ORM pour la gestion des tables
**/
abstract class Modele {
	/**
	 * Nom de la clé primaire de la table concernée
	 * @var string
	 */
	protected $primaryKeyName;
	
	/**
	 * Nom de la table de la base de données
	 * @var string
	 */
	protected $tableName;
	
	/**
	 * Méthode de mise à jour des données dans la table
	 * Implémentée dans les classes filles
	 * @param array $postedDatas : Données postées à partir d'un formulaire
	 */
	abstract public function save($postedDatas);
	
	/**
	 * Méthode de création et d'exécution d'une requête SELECT sur la totalité de la table
	 */
	abstract public function select();
	
	/**
	 * Méthode de sélection d'une ligne dans la table concernée à partir de la valeur de son identifiant
	 * @param int $primaryKeyValue : valeur de la clé primaire à traiter
	 */
	abstract public function selectById($primaryKeyValue);
	
	/**
	 * Méthode de suppression d'une ligne dans la table courante
	 * @param int $primaryKeyValue
	 */
	public function delete($primaryKeyValue){
		$delete = "DELETE FROM " . $this->tableName . " WHERE " . $this->primaryKeyName . "=" . $primaryKeyValue . ";";

		$connexion = new dbConnect();
		$base = $connexion->getBase();
		if(!is_null($base)){
			$resultat = $base->exec($delete);
			if($resultat !== false){
				return true;
			}
		}
		return false;
	}
}