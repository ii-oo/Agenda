<?php
/**
* @name DefinitionEvenement.class.php Définit les attributs standards des événements, peut être étendue par la suite
* @author wedDev - Déc. 2016
* @package Objet/Agenda/Classes
* @version 1.0
**/
class DefinitionEvenement {
	/**
	* Définition des attributs de la classe
	**/
	
	/**
	*	Définit la date de début de l'événement
	* @var DateTime $dateDebut
	**/
	protected $dateDebut;
	
	/**
	*	Définit la date de fin de l'événement
	* @var DateTime $dateFin
	**/
	protected $dateFin;
	
	/**
	*	Définit l'heure de début de l'événement
	* @var DateTime $heureDebut
	**/
	protected $heureDebut;
	
	/**
	*	Définit l'heure de fin de l'événement
	* @var DateTime $heureFin
	**/
	protected $heureFin;
	
	/**
	* Titre de l'événement
	* @var string
	**/
	protected $titre;
	
	/**
	* Description de l'événement
	* @var string
	**/
	protected $description;
	
	
	/**
	* Méthode de définition ou de récupération de la valeur de l'attribut de classe $dateDebut
	* @return mixed \DefinitionEvenement | \DateTime
	* @todo Contrôler le type du paramètre $date
	* @todo Si l'attribut est nul, on retourne la date du jour, pour éviter les valeurs nulles
	* @todo Vérifier s'il s'agit d'une date (is_date)
	* @todo Vérifier si une date de fin a été définie et s'assurer que la date de début n'est pas supérieure
	**/
	public function dateDebut($date=null){
		if(is_null($date)){
			return $this->dateDebut;
		}
		$this->dateDebut = $date;
		return $this;
	}
	
	/**
	* Méthode de définition ou de récupération de la valeur de l'attribut de classe $dateFin
	* @return mixed \DefinitionEvenement | \DateTime
	* @todo Contrôler le type du paramètre $date
	* @todo Si l'attribut est nul, on retourne la date de début, pour éviter les valeurs nulles
	**/
	public function dateFin($date=null){
		if(is_null($date)){
			return $this->dateFin;
		}
		$this->dateFin = $date;
		return $this;
	}
	
	/**
	* Méthode de définition ou de récupération de la valeur de l'attribut de classe $heureDebut
	* @return mixed \DefinitionEvenement | \DateTime
	* @todo Contrôler le type du paramètre $time
	* @todo Si l'attribut est nul, on retourne l'heure courante, pour éviter les valeurs nulles
	**/
	public function heureDebut($time=null){
		if(is_null($time)){
			return $this->heureDebut;
		}
		$this->heureDebut = $time;
		return $this;
	}
	
	/**
	* Méthode de définition ou de récupération de la valeur de l'attribut de classe $heureFin
	* @return mixed \DefinitionEvenement | \DateTime
	* @todo Contrôler le type du paramètre $time
	* @todo Si l'attribut est nul, on retourne l'heure de début + 7h, pour éviter les valeurs nulles
	**/
	public function heureFin($time=null){
		if(is_null($time)){
			return $this->heureFin;
		}
		$this->heureFin = $time;
		return $this;
	}
	
	public function titre($titre=null){
		if(is_null($titre)){
			return $this->titre;
		}
		
		$this->titre = $titre;
		return $this;
	}
	
	public function description($description=null){
		if(is_null($description)){
			return $this->description;
		}
		
		$this->description = $description;
		return $this;
	}
	
	
	public function render(){
		$evenement = $this;
		if(property_exists($this,"lieu")){
			include("vue/public.php");
		} else {
			include("vue/prive.php");
		}
	}
	
	/**
	* Détermine de quel type est l'objet concerné : Privé ou Public
	* @return string
	**/
	public function getObjectType(){
		return get_class($this); // $this EST l'objet courant, get_class() retourne le nom de la classe dont l'objet est issu
	}
}