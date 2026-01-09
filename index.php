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
	<link src="style.css" type=text/css rel="stylesheet"/>
    <title>Bibliothèque</title>
</head>
<body>
    <div class="container-fluid">
		<?php
            require('entete.php');
        ?>
		<div class="row" id="top">
			<div class="col-sm-9">
				<div id="demo" class="carousel slide text-center" data-bs-ride="carousel">
					<!-- Indicators/dots -->
					<div class="carousel-indicators">
						<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
						<button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
						<button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
					</div>

					<!-- The slideshow/carousel -->

					<?php
						require_once('connexion.php');
						$stmt=$connexion->prepare("SELECT photo FROM livre order by dateajout DESC limit 3");
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->execute();
						echo '<div class="carousel-inner">';

						if($enregistrement = $stmt->fetch()){
							// echo "<center>";
							echo "<div class='carousel-item active'>";
							echo "<img src='images-couvertures/covers/" . $enregistrement->photo . "'alt=' . $enregistrement->photo . 'height=" . 450 . "'>";
							echo "</div>";
							//echo "</center>";
						}

						while($enregistrement = $stmt->fetch()){
							// echo "<center>";
							echo "<div class='carousel-item'>";
							echo "<img src='images-couvertures/covers/" . $enregistrement->photo . "'alt=' . $enregistrement->photo . 'height=" . 450 . "'>";
							echo "</div>";
							//echo "</center>";
						}
						echo '</div>';
						?>
					<!-- Left and right controls/icons -->
					<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
						<span class="carousel-control-prev-icon"></span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
						<span class="carousel-control-next-icon"></span>
					</button>
				</div>
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