<?php
/**
 * @name formulaire.php : Formulaire pour l'ajout / modification d'un événement
* @see Intranet/Civilite/vues/
**/
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		
		<!-- Inclure bootstrap.min.css //-->
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		
		<!-- Inclure le framework jQuery //-->
		<script src="" charset="utf-8"></script>
		
		<!-- Inclure les extensions bootstrap.js //-->
		<script src="" charset="utf-8" /></script>
		
	</head>
	
	<body>
	<!-- classe bootstrap .container : contraint l'affichage à une largeur de 1190px //-->
		<div class="container">
			<header>
				<h1>Gestion des événements : <?php echo $title; ?></h1>
			</header>
			
			<main>
				<form name="evenements" method="post" action="controller.php" enctype="multipart/form-data">
					<fieldset>
						<legend>Titre et description</legend>
						<div class="form-group">
							<label for="titre">Titre :</label>
							<input type="text" class="form-control" name="titre" id="titre" value="<?php echo $evenements->evenements["titre"]; ?>" />
						</div>
						<div class="form-group">
							<label for="description">Description :</label>
							<textarea class="form-control" name="description" id="description" cols="30" rows="5"><?php echo $evenements->evenements["description"]; ?></textarea>
						</div>
						<div class="form-group">
							<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
							<label for="image">Illustration :</label>
							<input type="file" class="form-control" name="image" id="image" accept=".jpg,.jpeg,.png,.gif, image/*" />
						</div>
						<div class="form-group">
							<label for="programme">Programme :</label>
							<input type="text" class="form-control" name="programme" id="programme" value="<?php echo $evenements->evenements["programme"]; ?>" />
						</div>
					</fieldset>
					<fieldset>
						<legend>Dates et heures</legend>
						<div class="form-group">
							<label for="date_debut">Date de début :</label>
							<input type="text" class="form-control" name="date_debut" id="date_debut" value="<?php echo $evenements->evenements["date_debut"]; ?>" />
						</div>
						<div class="form-group">
							<label for="date_fin">Date de fin :</label>
							<input type="text" class="form-control" name="date_fin" id="date_fin" value="<?php echo $evenements->evenements["date_fin"]; ?>" />
						</div>
						<div class="form-group">
							<label for="heure_debut">Heure de début :</label>
							<input type="text" class="form-control" name="heure_debut" id="heure_debut" value="<?php echo $evenements->evenements["heure_debut"]; ?>" />
						</div>
						<div class="form-group">
							<label for="heure_fin">Heure de fin :</label>
							<input type="text" class="form-control" name="heure_fin" id="heure_fin" value="<?php echo $evenements->evenements["heure_fin"]; ?>" />
						</div>							
					</fieldset>
					
					<fieldset>
						<legend>Type</legend>
						<div class="radio">
							<label>
								<input type="radio" name="type" id="type_public" value="1" checked="checked" />
								Public
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="type" id="type_prive" value="2" />
								Privé
							</label>
						</div>
						<div class="content">
							<div class="col-lg-6 current">
								<div class="form-group">
									<label for="lieu">Lieu :</label>
									<input type="text" class="form-control" name="lieu" id="lieu" value="<?php echo $evenements->evenements["lieu"]; ?>" />
								</div>
								<div class="form-group">
									<label for="places_disponibles">Places disponibles :</label>
									<input type="text" class="form-control" name="places_disponibles" id="places_disponibles" value="<?php echo $evenements->evenements["places_disponibles"]; ?>" />
								</div>
							</div>
							
							<div class="col-lg-6">
								<div class="form-group">
									<label for="commission">Commission :</label>
									<input type="text" class="form-control" name="commission" id="commission" value="<?php echo $evenements->evenements["commission"]; ?>" />
								</div>
								<div class="form-group">
									<label for="ordre_du_jour">Ordre du jour :</label>
									<input type="text" class="form-control" name="ordre_du_jour" id="ordre_du_jour" value="<?php echo $evenements->evenements["ordre_du_jour"]; ?>" />
								</div>
							</div>
						</div>
					</fieldset>
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><?php echo $buttonLabel; ?></button>
						<input type="hidden" name="clePrimaire" value="<?php echo $evenements->evenements["clePrimaire"]; ?>" />
					</div>
				</form>
			</main>
			
			<footer>
			</footer>
		</div>
	</body>
</html>