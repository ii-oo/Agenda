<?php
/**
* @name liste.php : Affiche les données de la table modules sous la forme d'un tableau
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
			<h1><?php echo $titre; ?> -  &copy; Webdev 2016</h1>
		</header>
		
		<table>
			<thead>
				<tr>
					<th>Id.</th>
					<th>Libellé</th>
					<th>URL</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					foreach($modules->modules as $module){?>
						<tr>
							<td><?php echo $module["clePrimaire"]; ?></td>
							<td>
								<a href="moduleController.php?id=<?php echo $module["clePrimaire"];?>">
									<?php echo $module["libelle"]; ?>
								</a>
							</td>
							<td>
								<a href="moduleController.php?id=<?php echo $module["clePrimaire"];?>">
									<?php echo $module["url"]; ?>
								</a>
							</td>
							<td>
								<a href="moduleController.php?context=delete&primaryKeyVal=<?php echo $module["clePrimaire"];?>" title="Supprimer" role="button" class="btn btn-danger">Sup.</a>
							</td>
						</tr>
					<?php }?>
			</tbody>
			
			<tfoot>
				<a href="moduleController.php?action=ajouter" class="btn btn-success" role="button">
					Ajouter
				</a>
			</tfoot>
		</table>
	</body>
</html>