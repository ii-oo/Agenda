<?php 
/**
 * Update.php : Script appelé en Ajax qui supprime le lien image de la base de données et le fichier image sur le serveur.
 */


$id = $_GET["id"];
//C:\wamp64\www\Objet\agenda3\back-end\Evenements\modele\evenements.class.php
// Traitement de l'opération : Suppression de la ligne dans la base
require_once("../modele/evenements.class.php");
require_once("../../../_const/dbConfig.class.php");
require_once("../../../Classes/Database/Connexion.class.php");
require_once("../../../Classes/Database/MySQL.class.php");
require_once("../../../Classes/Database/PostgreSQL.class.php");
require_once("../../../Classes/Database/Oracle.class.php");
require_once("../../../Classes/Database/dbConnect.class.php");
$evenement = new evenements();
$result = $evenement->updateImage($id);

//Prépare l'information à retourner au script jQuery
$resultat = array(
		"statut" => $result ? 1 : 0,
		"row" => "row_" . $id
);

// On envoi le tout vers la sortie standard en Json
/*
{
	"statut": 1,
	"row": "row_1"
}
*/
echo json_encode($resultat);

?>