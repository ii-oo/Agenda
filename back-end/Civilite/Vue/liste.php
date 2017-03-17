<?php
/**
* @name liste.php : Affiche les données de la table civilités sous la forme d'un tableau
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
		
		<table>
			<thead>
				<tr>
					<th>Id.</th>
					<th>Libellé</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					foreach($civilites->civilites as $civilite){?>
						<tr>
							<td><?php echo $civilite["clePrimaire"]; ?></td>
							<td>
								<a href="civiliteController.php?id=<?php echo $civilite["clePrimaire"];?>">
									<?php echo $civilite["libelle"]; ?>
								</a>
							</td>
						</tr>
					<?php }?>
			</tbody>
			
			<tfoot>
				<a href="civiliteController.php?action=ajouter" class="btn btn-success" role="button">
					Ajouter
				</a>
			</tfoot>
		</table>
	</body>
</html>