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
                <h2>Ajouter un nouveau livre</h2>
				<?php
                    require_once('connexion.php');
                    $stmt = $connexion->prepare("SELECT noauteur, nom, prenom FROM auteur ORDER BY nom, prenom");
                    $stmt->execute();
                ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="noauteur" class="form-label">Auteur:</label>
                        <select name="noauteur" class="form-control" id="noauteur" required>
                            <?php while ($auteur = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                                <option value="<?= $auteur->noauteur ?>"><?= $auteur->prenom . ' ' . $auteur->nom ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre:</label>
                        <input type="text" name="titre" class="form-control" id="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="isbn13" class="form-label">ISBN13:</label>
                        <input type="text" name="isbn13" class="form-control" id="isbn13" required>
                    </div>
                    <div class="mb-3">
                        <label for="anneeparution" class="form-label">Année de parution:</label>
                        <input type="text" name="anneeparution" class="form-control" id="anneeparution" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Résumé:</label>
                        <textarea name="detail" class="form-control" id="detail" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Image:</label>
                        <input type="text" name="photo" class="form-control" id="photo" required>
                    </div>
                    <div class="mb-3">   
                        <button type="submit" class="btn btn-primary">Ajouter livre</button>
                        <a href="index.php" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $insertStmt = $connexion->prepare("INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, photo) VALUES (:noauteur, :titre, :isbn13, :anneeparution, :detail, :photo)");
        
                        $noauteur = $_POST['noauteur'];
                        $titre = $_POST['titre'];
                        $isbn13 = $_POST['isbn13'];
                        $anneeparution = $_POST['anneeparution'];
                        $detail = $_POST['detail'];
                        $photo = $_POST['photo'];
        
                        $insertStmt->bindValue(':noauteur', $noauteur, PDO::PARAM_INT);
                        $insertStmt->bindValue(':titre', $titre, PDO::PARAM_STR);
                        $insertStmt->bindValue(':isbn13', $isbn13, PDO::PARAM_STR);
                        $insertStmt->bindValue(':anneeparution', $anneeparution, PDO::PARAM_INT);
                        $insertStmt->bindValue(':detail', $detail, PDO::PARAM_STR);
                        $insertStmt->bindValue(':photo', $photo, PDO::PARAM_STR);
        
                        $insertStmt->execute();
                        $nb_ligne_affectees = $insertStmt->rowCount();
        
                        if ($nb_ligne_affectees > 0) {
                            $dernier_numero = $connexion->lastInsertId();
                            echo "<div class='container mt-4'><div class='alert alert-success'>";
                            echo $nb_ligne_affectees . " livre(s) ajouté(s) avec succès.<br>";
                            echo "Dernier numéro de livre généré : " . $dernier_numero;
                            echo "</div></div>";
                        } else {
                            echo "<div class='container mt-4'><div class='alert alert-danger'>Erreur lors de l'ajout du livre.</div></div>";
                        }
                    }
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