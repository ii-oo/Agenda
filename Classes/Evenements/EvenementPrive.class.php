<?php
/**
* @name EvenementPrive.class.php Définition d'un événement de type privé, on peut imaginer que certaines informations
*	ne pourraient par exemple pas être affichée si on visualise l'agenda global pour ce type d'événement
* @author WedDev - Déc. 2016
* @package Objet/Agenda/Classes
* @version 1.0
**/

require_once("DefinitionEvenement.class.php");

class EvenementPrive extends DefinitionEvenement {
	/**
	* Définition des attributs de la classe
	**/
	
	/**
	* Objet qui contient la collection des membres d'une commission
	* @var object \MembreCommission
	**/
	private $membresCommission;
	
	/**
	* Commission interne concernée par l'événement
	**/
	public $commission;
	
	/**
	* Ordre du jour pour l'événement privé
	**/
	public $ordreDuJour;
	
	/**
	* Définition des méthodes de la classe
	**/
	public function __construct($membresCommission){
		$this->membresCommission = $membresCommission;
	}
	
	public function getMembreCommission(){
		return $this->membresCommission->getMembres();
	}
}