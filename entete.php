<?php session_start(); ?>
<div class="row">
	<div class="col-sm-9 bg-dark text-white">
        <p> La Bibliothèque de Moulinsart est fermé au public jusqu'à nouvel ordre.</p>
        <p> Mais il vous est possible de réserver et retirer vos livres via notre service Biblio Drive !</p>
        <form method="get" action="proposition.php">
            Auteur : <input type="text" name="Auteur" size="40"/>
            <button type="submit" class="btn btn-info">recherche</button>
        <form method="get" action="panier.php">
            <Button type="submit" class="btn btn-info">Panier</Button>
        </form>
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


