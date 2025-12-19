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
        <?php
            require('entete.php');
        ?>
		<div class="row">
			<div class="col-sm-6">
				<?php
                    require_once('connexion.php');
                    $reponse = $_GET["idlivre"];
                    $stmt=$connexion->prepare("SELECT * from livre l inner join auteur a on (l.noauteur = a.noauteur) where l.nolivre=:pnumero");
                    $stmt->bindValue(":pnumero", $reponse);
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();
                    $enregistrement = $stmt->fetch();
                    // echo '<h5> Auteur = ' . $enregistrement->prenom . '' . $enregistrement->nom . '</h5>';
                    // echo '<br>';
                    // echo '<h5> ISBN13 = ' . $enregistrement->isbn13 . '</h5>';
                    // echo '<br>';
                    // echo '<h3> Résumé du Livre : </h3>';
                    // echo '<br>';
                    // echo '<h5>' . $enregistrement->detail . '</h5>';
                    echo '
                        <h5> Auteur = ' . $enregistrement->prenom . '' . $enregistrement->nom . '</h5>',
                        '<br>',
                        '<h5> ISBN13 = ' . $enregistrement->isbn13 . '</h5>',
                        '<br>',
                        '<h3> Résumé du Livre : </h3>',
                        '<br>',
                        '<h5>' . $enregistrement->detail . '</h5>',
            '</div>',
            '<div class="col-sm-3">',
                '<img src="images-couvertures/covers/' . $enregistrement->photo . '" alt="' . $enregistrement->photo . '" height="' . 450 . '">',
            '</div>';
                ?>
			<div class="col-sm-3" >
				<?php
					require_once('formulaire.php');
				?>
			</div>
		</div>
	</div>
</body>
</html>