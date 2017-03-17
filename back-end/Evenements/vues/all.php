<?php
/**
* @name all.php : Liste l'ensemble des événements enregistrés
* @see Intranet/Civilite/vues/
**/
?>
<!doctype html>
<html>
<style>
::-webkit-input-placeholder { /* Pour Safari, Google Chrome, Opera 15+ */
   font-style: italic;
}
 
:-moz-placeholder { /* Pour Firefox 18- */
   font-style: italic;
}
 
::-moz-placeholder {  /* Pour Firefox 19+ */
   font-style: italic;
}
 
:-ms-input-placeholder {  /* Pour IE 9+ */
   font-style: italic;
}

</style>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		
		<!-- Inclure bootstrap.min.css //-->
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- Inclure style.css //-->
		<link href="../../css/style.css" rel="stylesheet" />
		
		<!-- Inclure le framework jQuery //-->
		<script src="../../javascript/jquery.min.js" charset="utf-8"></script>
		
		<!-- Inclure les extensions bootstrap.js //-->
		<script src="" charset="utf-8" /></script>
		
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
	</head>
	
	<body>
		<div class="container">
			<header>
				<h1>Gestion des événements : Tous les événements</h1>
				<input class="recherche" id="recherche" name="recherche" type="text" placeholder="Rechercher...">
				<a href="#" title="recherche" role="button" class="btn btn-info btn-sm">
					<i class="glyphicon glyphicon-search"></i>
				</a> 
			</header>
			
			<main>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Du</th>
							<th>Au</th>
							<th>Type</th>
							<th>Titre</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					
					<tbody>
						<!-- Une boucle sur tous les événements et une ligne <tr> par événement -->
						<?php foreach($evenements->evenements as $evenement){ ?>
							<tr id="row_<?php echo $evenement["clePrimaire"] ?>">
								<td><?php echo $evenement["clePrimaire"]; ?></td>
								<td><?php echo $evenement["date_debut"];?></td>
								<td><?php echo $evenement["date_fin"];?></td>
								<td>
									<?php if($evenement["type"] == 1){?>
										Public
									<?php } else { ?>
										Privé
									<?php } ?>
								</td>
								<td>
									<a href="controller.php?id=<?php echo $evenement["clePrimaire"]; ?>" title="Mettre à jour">
										<?php echo $evenement["titre"]; ?>
									</a>
								</td>
								<td>
									<a href="#" title="Supprimer" role="button" class="btn btn-danger" data-id="<?php echo $evenement["clePrimaire"];
									?>">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
								</td>
							</tr>
						<?php } ?>						
						<!-- N'oubliez pas un lien <a href="controller.php?id=???"> sur le titre pour mise à jour //-->
						<!-- N'oubliez pas un lien <a href="controller.php?id=???&context=delete"> sur la dernière colonne //-->
					</tbody>
					
					<tfoot>
						<!-- Le lien pour créer un nouvel événement //-->
					</tfoot>
				</table>
				<a href="controller.php?context=ajout" title="Ajout">Ajouter un évènement</a>
			</main>
			
			<footer>
			</footer>
		</div>
		<div id="dialog" class="dialog not-showed">
			<header></header>
			<blockquote></blockquote>
		</div>
		<div id="dialog-confirm" title="Supprimer l'évènement ?" class="not-showed">
  			<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Cet enregistrement sera définitevement supprimé et ne pourra pas être restauré. Etes-vous sûr ?</p>
		</div>
		<script charset="utf-8">
			$(".btn-danger").on("click", function(){// gestionnaire d'evenement
			
				var id = $(this).data("id");
				//ou var id = $(this).attr("data-id");
				$("#dialog-confirm" ).dialog(
					{	resizable: false, // ne redimensionne pas la boite de dialogue
				       	width: 600, //largeur de la boite de dialogue
				    	modal: true, // 
					   	buttons: {
				    	"Oui": function() {
				    		// A partir de ce moment, on peut essayer d'appeler un script côté serveur...
							$.ajax({
								url: "Ajax/delete.php", // Adresse du script qui doit être appelé sur le serveur
								data: {
										"id": id
									}, // Définit les données qui doivent être transmises au script delete.php
								type: "post", // Méthode à utiliser pour retransmettre des données au script delete.php (get ou post) 
								dataType: "json", // Manière dont on va récupérer les données retransmises par le script delete.php (json
								success: function(data){ // La requete a été exécuté avecc success
									console.log("L'appel à delete.php s'est déroulé correctement");
									//On va voir ce que le script delete.php nous a retourné
									console.log("Données retournées : " + JSON.stringify(data));
									// Réellement effacer le tr du tableau oprtant l'id row_???
									if(data.statut == 1){
										$("#" + data.row).remove(); // Supprime effectivement la ligne du tableau
										$("#dialog header").html("<h3>Suppression</h3>");
										$("#dialog blockquote").html("La suppression s'est bien déroulée");
									} else {
										console.log("Pas de chance... La suppression a échoué.")
										$("dialog blockquote").html("La suppression a échoué");
									}
									//Dans tous les cas on affiche le dialogue
									$("#dialog").show();
									setTimeout(
										function(){
													$("#dialog").hide("slow");
												   },2000
												);
								},
								error: function(){ // La requete vers delete.php a échoué
									console.log("Désolé, mais le script delete.php n'a pas pu être chargé correctement...");
								}
							});
							 $( this ).dialog( "close" );
				        },
				        "Non": function() {
				          $( this ).dialog( "close" );
				        }
				      }
				    });
			});

			$("#recherche").keypress(function() {
			    if($(this).val().length > 3) {
				    
					alert("caract > 4 !");
				}
			});
	</script>
	</body>
</html>