<?php
/**
* @name formulaire.php : Vue du formulaire de gestion des Civilités
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
		
		<form id="civilite" name="civilite" action="civiliteController.php" method="post">
			<div class="form-group">
				<label for="libelle">Libellé</label>
				<input type="text" name="libelle" class="form-control" value="<?php echo $laCivilite["libelle"]; ?>" placeholder="Civilité" size="30" maxlength="75" />
			</div>
			
			<div class="form-group">
				<button type="submit" name="<?php echo $buttonName; ?>" class="btn btn-success">
					<?php echo $buttonLabel; ?>
				</button>
				<input type="hidden" name="clePrimaire" value="<?php echo $laCivilite["clePrimaire"]; ?>" />
			</div>
		</form>
	</body>
</html>