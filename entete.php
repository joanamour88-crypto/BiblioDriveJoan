<?php session_start(); ?>
<div class="row">
    <div class="col-sm-2 bg-dark">
        <a href="index.php"><img href="index.php" src="images/LogoBiblio2.png" alt="Logo" width="250"></a>
    </div>
	<div class="col-sm-7 bg-dark text-white text-center">
        <p> La Bibliothèque de Moulinsart est fermé au public jusqu'à nouvel ordre.</p>
        <p> Mais il vous est possible de réserver et retirer vos livres via notre service Biblio Drive !</p>
        <form method="get" action="proposition.php">
            Auteur : <input type="text" name="Auteur" size="40"/>
            <button type="submit" class="btn btn-info">recherche</button>
        </form>
        <form method="get" action="panier.php">
            <Button type="submit" class="btn btn-info">Panier</Button>
        </form>
        <?php
            if ($_SESSION['profil'] == 'admin'){
                echo '<form method="get" action="nouvutilisateur.php">
                        <Button type="submit" class="btn btn-warning">Ajouter un nouvel utilisateur</Button>
                      </form>';
                echo '<form method="get" action="nouvlivre.php">
                        <Button type="submit" class="btn btn-warning">Ajouter un nouveau livre</Button>
                      </form>';
                header('Refresh:2');
            }
        ?>
	</div>
	<div class="col-sm-3 bg-dark text-center">
			<img src="Château_de_Moulinsart.jpg" alt="Château_de_Moulinsart" width="250">
	</div>
</div>
<div class="row">
    <div class="col-sm-12 bg-secondary text-white">
        <p>    </p>
    </div>
</div>


