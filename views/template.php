<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $t ?></title>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
		
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" 
		rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<script src="public/js/Pagination.js"></script>			
	</head>

	<body>
		<?php include ('navbar.php') ?>
		<div class='body--page'>
			<?= $content ?>
		</div>

		<script src="public/js/FormPersonnage.js"></script>
	</body>
</html>
