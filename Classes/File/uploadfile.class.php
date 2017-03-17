<?php
/**
 * @name uploadfile.class.php : Service de gestion d'upload de fichiers.
 * @ packageFile : Classe\File
 * @version : 1.0
 */
class Uploadfile{
	/**
	 * Tableau de stockage des types MIMES autorisés pour l'upload
	 * @var array $mimes
	 **/
	protected $mimes;
	
	/**
	 * Nom du champs concerné par l'upload dans le formulaire
	 * @var string $fieldName
	 **/
	protected $fieldName;
	
	/**
	 * Détermine le dossier dans lequel on uploade les fichier
	 * @var string $uploadPath
	 */
	protected $uploadPath;
	
	/**
	 * Instancie un nouvel objet de gestion d'upload
	 * @param string $fieldName=> Nom du champs à traiter pour cet upload
	 * Utilisation : $uploadFile = newuploadFile("image");
	 **/
	public function __construct($fieldName){
		$this->fieldName = $fieldName;
		/*
		 * Attention, le calcul du chemin relatif doit être fait à partir du script en cours d'exécution
		 */
		$this->uploadPath = "../../upload/";
	}
	/**
	 * Ajoute un type MIME à la liste des types MIME à autoriser
	 * 	@param string | array $mimeType
	 * 	@return \uploadFile
	 * Utilisation :
	 * 	$uploadFile = new uploadFile();
	 *	$uploadFile->addMime("image/jpeg")
	 *		->addmime("image/png")
	 *		->addmime(array("image/jpeg","image/png","image/gif"))
	 *		->addmime("image");
	 */
	public function addMime($mimeType){
		if(is_array($mimeType)){
			$this->mimes = $mimeType;
		} else {
			//Y-a-t-il un / dans le mime qui a été passé ?
			if(strpos($mimeType,"/")){
				if(!in_array($mimeType, $this->mimes)){
					$this->mimes[] = $mimeType;
				}
			} else {
				switch(strtolower($mimeType)){
					case "image":
					case "images":
						$this->mimes = array("image/jpeg","image/png","image/gif");
						break;
					case "office":
						$this->mimes = array("application/msword",
							"application/vnd.openxmlformats-officedocument.wordprocesssinggml.document",
							"application/vnd.oasis.opendocument.text"
						);
						break;
				}
			}
			
		}
		return $this;
	}
	
	/**
	 * traite l'upload du fichier proprement dit et retourne le chemin vers le fichier si tout est ok, ou null sinon
	 *
	 */
	public function process(){
		if(array_key_exists($this->fieldName, $_FILES)){
			// Cela signifie qu'un fichier a été transmis à partir du champ du formulaire identifié par $this->fieldName
			$tmpName = $_FILES[$this->fieldName]["tmp_name"];
			if($tmpName != ""){
				//C'est bon on peut continuer
				if($this->mimeAuthorized($tempName)){
					//  Le type MIME est autorisé, on peut continuer
					if($_FILES[$this->fieldName]["error"] == UPLOAD_ERR_OK){
						//Calcule le chemin relatif du dossier upload/ ici
						$fullPath = "../../" . $this->uploadPath;
						move_uploaded_file($tmpName, $this->uploadPath . $_FILES[$this->fieldName]["name"]);
						return $this->uploadPath . $_FILES[$this->fieldName]["name"];
					}
					
				}
			}
		}
	}
	/**
	 * Retourne vrai, si le type mime du fichier temporaire fait partie de la liste des types autorisés
	 * @param string $tempName : Nom du fichier temporaire uploadé
	 * @return array
	 */
	private function mimeAuthorized($tempName){
		$mimeType = mime_content_type($tempName);
		return in_array($mimeType, $this->mimes);
	}
}