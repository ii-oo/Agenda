<?php
/**
* @name EvenementPublic.class.php Définition d'un événement de type public, permettant d'introduire d'autres informations
* @author WedDev - Déc. 2016
* @package Objet/Agenda/Classes
* @version 1.0
**/

require_once("DefinitionEvenement.class.php");

class EvenementPublic extends DefinitionEvenement {
	/**
	* Définition des attributs de la classe
	**/
	
	/**
	* Lieu de l'événement
	**/
	private $lieu;
	
	/**
	* Nombre de places disponibles
	**/
	protected $placesDisponibles;
	
	/**
	* Définition des méthodes de la classe
	**/
	
	public function __construct(){
		// Définition des valeurs par défaut, de manière à ce que l'objet puisse être cohérent
		// même si on ne passe pas en revue tous les "setters" dans le contrôleur
		$this->placesDisponibles = 0;
		$this->description = "Informations à venir";
	}
	
	/**
	*	Définit ou retourne le nombre de places disponibles pour l'événement public
	*	@param Optionnel int $places
	*	@return int | /EvenementPublic
	* Depuis le monde extérieur : un contrôleur
	* $object->placesDisponibles(10); => $places vaut 10
	* $object->placesDisponibles(); => Aucun paramètre n'est passé, dans ce cas, $places=null
	**/
	public function placesDisponibles($places=null){
		if(is_null($places)){
			return $this->placesDisponibles;
		}
		
		if(is_int($places)){
			$this->placesDisponibles = $places;
		}
		
		return $this;
	}
	
	public function lieu($lieu=null){
		if(!is_null($lieu)){
			$this->lieu = $lieu;
			return $this;
		}
		
		return $this->lieu;
	}
}