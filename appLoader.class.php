<?php 
/**
 * @name appLoader.class.php : Classe de chargement des applications
 * @package : \
 * @version 1.0 \
 *
 */

class appLoader{
	/**
	 * Stocke le dossier racine de l'application courante, base de la recherche
	 * @var string
	 */	
	private static $dossierRacine;
	
	public function __construct(){
		// Fonction qui définit l'autoloader de classes
		spl_autoload_register(array(__CLASS__,"autoload"));
	}
	/*
	 * Méthode statique (ou fonction...) qui sera appelée automatiquement
	 * lors de l'instanciation d'une classe
	 */
	public static function autoload($className){
		self::$dossierRacine = $_SERVER["DOCUMENT_ROOT"] . "/agenda3/";
		//1.On cherche d'abord dans le dossier Classes de l'application
		echo "Dossier racine : " . $_SERVER["DOCUMENT_ROOT"] . "<br />";
		echo "On veut charger la classe : " . $className . "<br />";
		$cheminCompletClasse = self::chercherClasse(self::$dossierRacine, $className);
		echo "Le chemin complet de la classe => " . $cheminCompletClasse . "<br />";
		if(!$cheminCompletClasse){
			$cheminCompletClasse = self::chercherClasse("/", $className);
		}		
		if(!$cheminCompletClasse){
			require_once($cheminCompletClasse);
			return true;
		}
		throw new Exception("Impossible de trouver la classe " . $classeName, -100001);
	}

	private static function chercherClasse($dossier, $className){
		echo "Dossier : " . $dossier . " ClassName : " . $className . "<br />".
		//DirectoryIterator retourne la liste des dossier et des fichiers du dossier $dossier
		$listeFichier = new DirectoryIterator($dossier);
		
		foreach($listeFichier as $element){
			if($element->isDot()){
				"dossier : " . $dossier . " on a un dossier \".\" ou \"..\"<br />";
				//vient à l'instruction foreach sans exécuter tout le reste
				continue;
			}
			if($element->isDir()){
				echo "L'élément est un dossier, il s'appelle " . $element->getFileName() . "<br />"; 
				//L'élément lu est un dossier, on vérifie que le dossier commence par "_"
				if(substr($element->getfilename(),0,1)== "_"){
					continue;
				}
			
				// il s'agit d'un dossier, on va entrer dans ce nouveau dossier pour le parcourir à son tour
				if($resultat = self::chercherClasse($dossier, $element->getfilename() . "/", $className)){
					echo "C'est un dossier, on rentre en récursion (rappel de fonction) avec les paramètres : " . $dossier . $element->getfilename();
					//On a donc trouvé dans ce nouveau dossier ce qu'on cherche...
					return $resultat;
				} else {
					continue; //On passe à l'élément suivant
				}
		} else {
			echo "On traite un fichier dontn le nom est : " . $element->getFilename() . " on le compare à " . $className . "<br />\n";		
			// Il s'agit donc d'un fichier...
			if($element->getfilename() == $className . "class.php"
					|| $className . ".php"
					|| "class" . $className . ".php"){
				//Et il s'agit bien de celui qu'on cherche
				echo "C'est le fichier que l'on recherche, on le retourne... <br />\n";
				return $dossier . $element->getFilename();
			}
			}
		}
		echo "On n'a pas trouvé le fichier " . $className;
		return false; // LE fichier demandé n'a pas pu être trouvé
	}
}
?>
