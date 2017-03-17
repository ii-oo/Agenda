<?php
/**
* @name civiliteController.php : Contrôle les opérations de traitement sur les civilités
**/
require("../../Module/Modele/Module.class.php");

/**
* Instancier un nouvel objet ORM : charge le modèle
**/
$modules = new Module();

/**
* Détermine le contexte d'exécution
**/

/**
 * Peut être que le tableau interne $_POST a été défini
 *	Ce sera le cas lorsque l'utilisateur aura cliqué sur un bouton submit du formulaire
 **/
if(sizeof($_POST) > 0){
	// Le tableau $_POST n'est pas vide si le bouton "submit" d'un formulaire a été utilisé
	$modules->save($_POST);
}

if(!isset($_GET["id"])){
	if(!isset($_GET["action"])){
		// On va vérifier que le contexte est un "delete"
		if(isset($_GET["context"]) && $_GET["context"] == "delete"){
			$modules->delete($_GET["primaryKeyVal"]);
		}
		
		// Pas de paramètre "id" dans l'url, et pas "action" non plus, a priori, on doit lister toutes les civilités
		$modules->select();
		#begin_debug
		#var_dump($civilites->civilites);
		#end_debug
		$titre = "Liste des modules";
		$vue = "vue/liste.php";
	} else {
		// L'URL transmise est moduleController.php?action=ajouter
		$titre = "Ajouter un module";
		$vue = "vue/formulaire.php";
		$buttonLabel = "Ajouter";
		$buttonName = "inserer";
		// Initialise le tableau $leModule
		$leModule = array(
			"clePrimaire" => "",
			"libelle" => "",
			"url" => ""
		);
	}
} else {
	// Un identifiant transmis dans l'url, ne récupérer que le module correspondant
	$titre = "Mettre à jour un module";
	$vue = "vue/formulaire.php";
	$buttonLabel = "Mettre à jour";
	$buttonName = "modifier";
	// Il faut faire une requête dans la base avec l'ID concerné
	$leModule = $modules->selectById($_GET["id"]);
}

/**
* Charger le modèle définitif
**/
include($vue);