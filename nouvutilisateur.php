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
				<h2>Ajouter un nouveau membre</h2>
                <?php
                    if ($_SESSION['profil'] === "admin"){
                ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="mel" class="form-label">Mel:</label>
                        <input type="email" name="mel" class="form-control" id="mel" required>
                    </div>
                    <div class="mb-3">
                        <label for="motdepasse" class="form-label">Mot de passe:</label>
                        <input type="password" name="motdepasse" class="form-control" id="motdepasse" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" name="nom" class="form-control" id="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prenom:</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse:</label>
                        <input name="adresse" class="form-control" id="adresse" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville:</label>
                        <input type="text" name="ville" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="postal" class="form-label">code postale:</label>
                        <input type="text" name="postal" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter le membre</button>
                    <a href="index.php" class="btn btn-secondary">Annuler</a>
                </form>
                <?php
                    }else{
                        header('location: index.php');
                    }
                require_once('connexion.php');
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Préparation de la requête d'insertion
                    $insertStmt = $connexion->prepare("INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, codepostal, ville, profil) VALUES (:mel, :motdepasse, :nom, :prenom, :adresse, :codepostal, :ville, 'membre')");
                    
                    // Récupération des valeurs du formulaire
                    $mel = $_POST['mel'];
                    $motdepasse = $_POST['motdepasse'];
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $adresse = $_POST['adresse'];
                    $codepostal = $_POST['postal'];
                    $ville = $_POST['ville'];
                    -
                    // Liaison des paramètres
                    $insertStmt->bindValue(':mel', $mel);
                    $insertStmt->bindValue(':motdepasse', $motdepasse);
                    $insertStmt->bindValue(':nom', $nom);
                    $insertStmt->bindValue(':prenom', $prenom);
                    $insertStmt->bindValue(':adresse', $adresse);
                    $insertStmt->bindValue(':codepostal', $codepostal);
                    $insertStmt->bindValue(':ville', $ville);
                    
                    // Exécution de la requête
                    if ($insertStmt->execute()) {
                        echo "<div class='container mt-4'><div class='alert alert-success'>Membre ajouté avec succès.</div></div>";
                    } else {
                        echo "<div class='container mt-4'><div class='alert alert-danger'>Erreur lors de l'ajout du membre.</div></div>";
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