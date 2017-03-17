<?php
/**
*
**/
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		
		<!-- Inclure bootstrap.min.css //-->
		<link href="" rel="stylesheet" />
		
		<!-- Inclure le framework jQuery //-->
		<script src="" charset="utf-8"></script>
	</head>
	
	<body>
		<nav>
			<ul>
				<li class="active">
					<a href="#" title="Tous les événements">Tous les événements</a>
					[<a href="controller.php?type=tous" title="Tous les événements">Tous les événements</a>]
				</li>
				<li>
					<a href="controller.php?type=public" title="Evénements publics">Publics</a>
				</li>
				<li>
					<a href="controller.php?type=prive" title="Evénements prives">Privés</a>
				</li>
			</ul>
		</nav>
		
		<main>
			<?php foreach($events as $event){?>
				<article class="panel">
					<?php $event->render(); ?>
				</article>
			<?php } ?>
		</main>
	</body>
</html>