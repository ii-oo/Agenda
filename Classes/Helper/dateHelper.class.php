<?php
/**
 * dateHelper.class.php : Services statiques de traitement de données de type date et heure
**/
class dateHelper{
	public static $mois = array(
			"Janvier",
			"Février",
			"Mars",
			"Avril",
			"Mai",
			"Juin",
			"Juillet",
			"Août",
			"Septembre",
			"Octobre",
			"Novembre",
			"Décembre"
	);
	
	/**
	 * public : accessible de n'importe quel endroit (monde extérieur)
	 * static : la méthode est appelée sans avoir besoin d'instancier un objet au préalable (dateHelper::toFrDate())
	 * final : elle ne pourra donc pas être surchargée dans une éventuelle classe fille
	 * Convertit une date au format US (AAAA-MM-JJ) vers un format FR (JJ-MM-AAAA)
	 * @var string $strDate : chaîne contenant une date au format US
	 **/
	public static final function toFrDate($strDate,$outFormat="d-m-Y", $moisEnClair=false){
		// Utiliser la classe interne DateTime pour créer un objet de type DateTime
		$oDate = new DateTime($strDate);
	
		$mois = $oDate->format("n");
		$indice = $mois - 1; // Un tableau, ça part toujours de 0...
		$moisEnClair = self::$mois[$indice];
	
		if($moisEnClair !== false){
			return $oDate->format($outFormat);
		} else {
			return $oDate->format("d") . " " . $moisEnClair . " " . $oDate->format("Y");
		}
	}
	
	public static final function toUsDate($strDate, $format="d-m-Y"){
		$oDate = DateTime::createFromFormat($format, $strDate);
		#$oDate = new DateTime($strDate);
		return $oDate->format("Y-m-d");
	}
}