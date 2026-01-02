<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css"/>
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
					require('entete.php');
				?>
			</div>
			<div class="col-sm-3 bg-info">
					<img src="Château_de_Moulinsart.jpg" alt="Château_de_Moulinsart" width="150" height="100">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
				<?php
                    require_once('connexion.php');
                    $stmt=$connexion->prepare("SELECT * from livre l inner join auteur a on (l.noauteur = a.noauteur) where a.nom like :aut");
                    
                ?>
			</div>
			<div class="col-sm-3" >
				<?php
					require_once('formulaire.php');
				?>
			</div>
		</div>
	</div>
</body>
</html>