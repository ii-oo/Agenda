<?php
/**
* @name formulaire.php : Vue du formulaire de gestion des Modules
**/
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no,max-scale=1.0" />
		
		<title><?php echo $titre; ?></title>
		
		<link href="" rel="stylesheet" />
	</head>
	
	<body>
		<header>
			<h1><?php echo $titre; ?></h1>
		</header>
		
		<form id="module" name="module" action="moduleController.php" method="post">
			<div class="form-group">
				<label for="libelle">Libellé</label>
				<input type="text" name="libelle" class="form-control" value="<?php echo $leModule["libelle"]; ?>" placeholder="Nom du module" size="30" maxlength="75" />
			</div>
			<div class="form-group">
				<label for="url">URL d'accès</label>
				<input type="text" name="url" class="form-control" value="<?php echo $leModule["url"]; ?>" placeholder="Chemin relatif" size="30" maxlength="75" />
			</div>			
			<div class="form-group">
				<button type="submit" name="<?php echo $buttonName; ?>" class="btn btn-success">
					<?php echo $buttonLabel; ?>
				</button>
				<input type="hidden" name="clePrimaire" value="<?php echo $leModule["clePrimaire"]; ?>" />
			</div>
		</form>
	</body>
</html>