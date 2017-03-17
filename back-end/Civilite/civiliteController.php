<?php
/**
* @name civiliteController.php : Contrôle les opérations de traitement sur les civilités
**/
require("../../Civilite/Modele/Civilite.class.php");

/**
* Instancier un nouvel objet ORM : charge le modèle
**/
$civilites = new Civilite();

/**
* Détermine le contexte d'exécution
**/

/**
 * Peut être que le tableau interne $_POST a été défini
 *	Ce sera le cas lorsque l'utilisateur aura cliqué sur un bouton submit du formulaire
 **/
if(sizeof($_POST) > 0){
	// Le tableau $_POST n'est pas vide si le bouton "submit" d'un formulaire a été utilisé
	$civilites->save($_POST);
}

if(!isset($_GET["id"])){
	if(!isset($_GET["action"])){
		// Pas de paramètre "id" dans l'url, et pas "action" non plus, a priori, on doit lister toutes les civilités
		$civilites->select();
		#begin_debug
		#var_dump($civilites->civilites);
		#end_debug
		$titre = "Liste des civilités";
		$vue = "vue/liste.php";
	} else {
		// L'URL transmise est civiliteController.php?action=ajouter
		$titre = "Ajouter une civilité";
		$vue = "vue/formulaire.php";
		$buttonLabel = "Ajouter";
		$buttonName = "inserer";
		// Initialise le tableau $laCivilite
		$laCivilite = array(
			"clePrimaire" => "",
			"libelle" => ""
		);
	}
} else {
	// Un identifiant transmis dans l'url, ne récupérer que la civilité correspondante
	$titre = "Mettre à jour une civilité";
	$vue = "vue/formulaire.php";
	$buttonLabel = "Mettre à jour";
	$buttonName = "modifier";
	// Il faut faire une requête dans la base avec l'ID concerné
	$laCivilite = $civilites->selectById($_GET["id"]);
}

/**
* Charger le modèle définitif
**/
include($vue);