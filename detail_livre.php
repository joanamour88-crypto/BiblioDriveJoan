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
		<div class="row" id="top">
			<div class="col-sm-9">
				<?php
                    require_once('connexion.php');
                    $reponse = $_GET["idlivre"];
                    $stmt=$connexion->prepare("SELECT * from livre l inner join auteur a on (l.noauteur = a.noauteur) where l.nolivre=:pnumero");
                    $stmt->bindValue(":pnumero", $reponse);
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();
                    $enregistrement = $stmt->fetch();
                    echo 
                        '<div class="col-sm-6">',
                            '<h5> Auteur = ' . $enregistrement->prenom . '' . $enregistrement->nom . '</h5>',
                            '<br>',
                            '<h5> ISBN13 = ' . $enregistrement->isbn13 . '</h5>',
                            '<br>',
                            '<h3> Résumé du Livre : </h3>',
                            '<br>',
                            '<h5>' . $enregistrement->detail . '</h5>';
                    if (isset($_SESSION['mail'])){
                        echo
                        '<form method="get" action="detail_livre.php.php">',
                            //'<input type="hidden" name="idlivre" value="' . $enregistrement->nolivre . '"/>',
                            '<button type="submit" name="ajoutpanier" class="btn btn-outline-info">Ajouter au panier</button>',
                        '</form>';
                    }
                    else{
                        echo '<h5> Veuillez vous connecter pour ajouter au panier </h5>';
                    }
                    echo
                        '</div>',
                        '<div class="col-sm-6">',
                            '<img src="images-couvertures/covers/' . $enregistrement->photo . '" alt="' . $enregistrement->photo . '" height="' . 400 . '">',
                        '</div>';
                ?>
            </div>
			<div class="col-sm-3">
				<?php
					require_once('formulaire.php');
				?>
			</div>
		</div>
	</div>
</body>
</html>