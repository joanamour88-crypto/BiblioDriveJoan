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

                    $stmt=$connexion->prepare("SELECT * from emprunter where nolivre");
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();
                    $enregistrement2 = $stmt->fetch();

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

                        if ($enregistrement->nolivre == $enregistrement2->nolivre){
                            echo '<h5 style="color:red;"> Livre déjà emprunté </h5>';
                        } else {
                            echo '<h5 style="color:green;"> Livre disponible </h5>';
                        }
                        echo
                        '<form method="get" action="detail_livre.php">',
                            //'<input type="hidden" name="idlivre" value="' . $enregistrement->nolivre . '"/>',
                            '<button type="submit" name="ajoutpanier" value="' . $enregistrement->nolivre . '" class="btn btn-outline-info">Ajouter au panier</button>',
                        '</form>';
                        if (isset($_GET['ajoutpanier'])) {
                            $book_id = $_GET['ajoutpanier'];
                            if (!isset($_SESSION['panier'])) {
                                $_SESSION['panier'] = array();
                            }
                            if (!in_array($book_id, $_SESSION['panier'])) {
                                $_SESSION['panier'][] = $book_id;
                            }
                            header('Location: panier.php');
                            exit();
                        }
                    }
                    else{
                        echo '<h5 class="text-danger"> Veuillez vous connecter pour ajouter au panier </h5>';
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