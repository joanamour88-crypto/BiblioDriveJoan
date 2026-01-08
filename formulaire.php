<div class="bg-dark text-white text-center p-3 rounded-4">
    <?php
        if (isset($_SESSION["mail"])){
            echo $_SESSION['prenom'] . " " . $_SESSION['nom'] . "<br>";
            echo $_SESSION['adresse'] . "<br>";
            echo $_SESSION['ville'] . " " . $_SESSION['codepost'] . "<br>";
            echo '
            <form action="index.php" method="post" id="top">
                <button type="submit" name="deco" class="btn btn-danger">Deconnexion</button>  
            </form>';
        }else{
            if (!isset($_POST["btn"])){
            echo '<form action="index.php" method="post">
            <h3>CONNEXION</h3>
            <h4>Identifiant</h4>
            <input type="text" name="mail" size="20"/>
            <h4>Mot de passe</h4>
            <input type="password" name="Mdp" size="20"/><br>
            <button type="submit" class="btn btn-outline-info" name="btn" id="top">Se Connecter</button>                
            </form>';
            }else{
                $Mail = $_POST["mail"];
                $Mdp = $_POST["Mdp"];
            
                require_once("connexion.php");

                $stmt=$connexion->prepare("SELECT * from utilisateur where mel = :mail and motdepasse = :Mdp");
                $stmt->bindValue(':mail', $Mail, PDO::PARAM_STR);
                $stmt->bindValue(':Mdp', $Mdp, PDO::PARAM_STR);
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $stmt->execute();
                $enregistrement=$stmt->fetch();

                $_SESSION['mail'] = $Mail;
                $_SESSION['prenom'] = $enregistrement->prenom;
                $_SESSION['nom'] = $enregistrement->nom;
                $_SESSION['adresse'] = $enregistrement->adresse;
                $_SESSION['ville'] = $enregistrement->ville;
                $_SESSION['codepost'] = $enregistrement->codepostal;
                $_SESSION['profil'] = $enregistrement->profil;

                echo $_SESSION['prenom'] . " " . $_SESSION['nom'] . "<br>";
                echo $_SESSION['adresse'] . "<br>";
                echo $_SESSION['ville'] . " " . $_SESSION['codepost'] . "<br>";
                echo '
                <form action="index.php" method="post">
                    <button type="submit" name="deco">Deconnexion</button>  
                </form>';
            }
        } 
        if (isset($_POST["deco"])){
            session_destroy();
            header("Location: index.php");
        }
    ?>
</div>