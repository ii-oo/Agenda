<?php
/**
* @name listeDiv.php : Vue permettant de lister les civilités sous forme de DIV
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
		
		<!-- Début de l'affichage des civilités //-->
		<?php
			foreach($civilites->civilites as $civilite){ ?>
				<div class="row">
					<div class="id"><?php echo $civilite["id"]; ?></div>
					<div class="libelle">
						<?php echo $civilite["libelle"]; ?>
					</div>
					<div class="action">
						<a href="civiliteController.php?id=<?php echo $civilite["id"]; ?>" class="btn primary-btn" role="button">
							Mettre à jour
						</a>
					</div>
				</div>
		<?php } ?>
		
		<a href="civiliteController.php?action=ajouter" class="btn btn-success" role="button">
			Ajouter
		</a>
	</body>
</html>