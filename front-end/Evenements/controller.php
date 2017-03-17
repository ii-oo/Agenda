<?php
/**
* @name controller.php : Contrôleur d'affichage d'événements d'un agenda
* @author webDev - Déc. 2016
* @package Objet/Agenda
* 	Instancie différents événements (publics ou privés) pour mise à disposition d'un agenda dans les vues
*		- vues/all.php : Tous les événements dans l'ordre chronologique inverse
*		- vue/public.php : Seulement les événements publics dans l'ordre chronologique inverse
*		- vue/dashboard.php : Tous les événements dans un tableau pour "administration"
**/

require("../../Classes/Evenements/DefinitionEvenement.class.php");
require("../../Classes/Evenements/EvenementPublic.class.php");
require("../../Classes/Evenements/EvenementPrive.class.php");

/**
* Cette classe va permettre de "collectionner" les événements
* De récupérer les événements collectionnés en fonction des besoins :
*	- Tous les événements dans l'ordre chronologique
*	- Les événements "publics" seulement dans l'ordre chronologique
*	- Tous les événements mais dans l'ordre alphabétique
**/
require("../../Classes/Evenements/agenda.class.php");

$agenda = new agenda();

/**
* @update 1 : Récupérer tous les événements de la base de données
*(@see back-end/evenements/evenements.class.php::select()
*/

$evenements = new evenement();

$evenement->select();

/**
* @update 2 : Boucler sur tous les événements et à chaque occurrence :
*	Créer un objet (EvenementPublic ou EvenementPrive) en fonction de la valeur de la colonne type
*	Ajouter l'objet créé à la collection des objets de l'agenda @see agenda::addEvenement()
**/

foreach($evenements as $evenement){
	if($evenemen->type)
}


/**
* @update 3 : Inspecter le contexte pour agir en conséquence :
*	- Afficher TOUS les événements triés par date
*	- N'afficher QUE les événements publics triés par date
*	- N'afficher QUE les événements privés triés par date
* Appeler les méthodes de la classe Agenda (getAllBy(), ...)
**/

/**
* Charger la vue correspondante
**/

include("vues\all.php");

