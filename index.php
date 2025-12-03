<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Bibliothèque</title>
</head>
<body>
    <div class="container-fluid">
		<div class="row">
			<div class="col-sm-9">
				<?php
					require('entete.php')
				?>
			</div>
			<div class="col-sm-3">
					<img src="Château_de_Moulinsart.jpg" alt="Château_de_Moulinsart" width="460" height="345">
			</div>
		</div>
		<div class="row">
		   <div class="col-sm-9">
					carroussel / résultat de la recherche / pages d'admin (ajout d'un livre)
			</div>
			<div class="col-sm-3" >
					formulaire de connexion / profil connecté (include)
			</div>
		</div>
</body>
</html>