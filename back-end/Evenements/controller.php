 <?php
/**
 * @name controller.php => Contrôleur du back-end CRUD sur la table evenements
* @author webdev - Déc. 2016
* @package Agenda/back-end/Evenements
* @version 1.0
* @see Intranet/Civilite/civiliteController.php
**/
/**
 * Importer le loader d'application
 */
echo "Fichier de base => " .dirname(__FILE__) . "../../../appLoader.class.php" . "<br />";

require_once (dirname(__FILE__) . "../../../appLoader.class.php");
$appLoader = new appLoader();

/**
 * 1. Importer les classes nécessaires pour le fonctionnement du contrôleur
**/
//require("modele/evenements.class.php"); // ORM faisant la relation entre le backend et la table evenements
//require("../../Classes/Helper/dateHelper.class.php");

# Test de la méthode statique toFrDate()
#echo dateHelper::toFrDate("2016-12-23","d-m-Y", true);

# Test de la méthode statique toUsDate()
#echo dateHelper::toUsDate("23/12/2016","d/m/Y");

/**
 * Instanciation d'un nouvel objet evenements
 **/
$evenements = new evenements();

// On veut sélectionner toutes les données de la table
#$evenements->select();
#begin_debug
#var_dump($evenements->evenements);
#end_debug

// On teste la méthode selectById($id)
#$evenements->selectById(-50);
#begin_debug
#var_dump($evenements->evenements);
#end_debug

/**
 * 2. Savoir si des données ont été postées et agir en conséquence : Ajouter ou Modifier l'information
 **/
if(sizeof($_FILES)){ //Si des données ont été postées Taille > 0
	$mimes = array(
			"image/jpeg",
			"image/png",
			"image/gif"
			);
	$tempName = $_FILES["image"]["tmp_name"];// La clé tmp_name contient le nom "arbitraire" utilisé pour la transmission vers le serveur.
	$name = $_FILES["image"]["name"]; // La clé name contient le nom du fichier d'origine
	//var_dump($_FILES);
	echo "Fichier transmis : " . $tempName . "<br/> Nom du fichier d'origine : " . $name . "<br />";
	//Verification du type MIME du fichier transmis
	$mimetype = mime_content_type($tempName); // Retourne le type MIME du fichier uploadé
	echo "Type MIME du document transféré : " . $mimetype . "<br />";
	if($_FILES["image"]["error"] == UPLOAD_ERR_OK) { // UPLOAD_ERR_OK => Constante interne à PHP qui indique que l'upload s'est bien déroulée (=0)
		if(in_array($mimeType, $mimes)){
			//On interdit aussi un certain nombre de caractères non autorisés
			/**
			 * Interdires les espaces dans le nom du fichier
			 * Interdire les caractères accentués
			 * Interdire certains caractères spéciaux ("/"... qui ne sont pas vraiment aimés de tout les systèmes)
			 * Utiliser les fonctions replace de PHP pour remplacer
			 **/
			// Avant de procéder au déplacement lui-même, on vérifie qu'il n'y a pas déjà un fichier portant ce nom.
			if(!file_exists("../../upload/" . $names)){
				move_uploaded_file($tempName, "../../upload/" . $name);				
			} else {
				// image1.jpg => image1[1].jpg
				//
			}
		}
	}
}
#var_dump($_POST);
if(sizeof($_POST)){
	$evenements->save($_POST);
}
/**
 * 3. Inspecter les données de la requête HTTP ($_GET) pour savoir ce que vous avez à faire :
 *	- Afficher la liste des événements de votre base de données
 *	- ou Supprimer un événement dont vous connaîtrez l'id
 *	- Afficher le formulaire d'ajout d'un événement
 *	- Afficher le formulaire de mise à jour d'un événement
 **/
#var_dump($_GET);

/**
 * En fonction de l'état du tableau $_GET on choisit la vue à charger et les éventuels traitements à réaliser
 *	- $_GET vide => charger all.php après avoir exécuté la méthode "select()"
 **/
if(sizeof($_GET) == 0){
	$evenements->select(); // La méthode select() pour lister tous les événements est appelée
	$vue = "vues/all.php";
	$title = "Tous les événements";
} else {
	// Contrôle si un id a été passé, si c'est le cas, on charge la ligne correspondante dans la base de données
	if(isset($_GET["id"])){
		// On doit charger la ligne concernée et afficher le formulaire de mise à jour
		$evenements->selectById($_GET["id"]);
		$vue = "vues/formulaire.php";
		$title = "Mettre à jour " . $evenements->evenements["titre"];
		$buttonLabel = "Mettre à jour";
	}

	if(isset($_GET["context"])){
		if($_GET["context"] == "ajout"){
			$evenements->emptyEvents(); // Crée un tableau avec les clés vides...
			$vue = "vues/formulaire.php";
			$title = "Ajouter un événement";
			$buttonLabel = "Ajouter";
		}
	}
}

/**
 if(isset($_GET["context"]) && $_GET["context"] == "delete"){
 echo "J'ai demandé au contrôleur de supprimer un événement<br />";
 if(!isset($_GET["id"])){
 echo "Mais j'ai oublié de dire quel identifiant supprimer !<br />";
 } else {
 echo "Et l'événement à supprimer est : " . $_GET["id"] . "<br />";
 }
 }
 **/

/**
 * 4. Charger la vue correspondante à ce qui a été défini à l'étape 3
 **/
include($vue);