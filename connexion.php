<?php
    include('config/config.php'); 
    session_start();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['mdp'];

        try {
            $bdd = new PDO("mysql:host=$hote;dbname=$nom_bd", $identifiant, $mot_de_passe);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $bdd->prepare("SELECT UserID, NomUtilisateur, Email, MotDePasse FROM Utilisateurs WHERE Email = :email");
            $requete->execute(['email' => $email]);

            if ($utilisateur = $requete->fetch(PDO::FETCH_ASSOC)) {
                // verification du mot de passe 
                if ($password === $utilisateur['MotDePasse']) {
                    // connexion ok
                    $_SESSION['UserID'] = $utilisateur['UserID'];
                    $_SESSION['NomUtilisateur'] = $utilisateur['NomUtilisateur'];
                    header("Location: espace_membre.php");
                    exit;
                } else {
                    echo "Mot de passe incorrect.";
                }
            } else {
                echo "Aucun utilisateur trouvé avec cet email.";
            }
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    ?>


<body> 
    <?php include("navbar.php"); ?>
    <div class="page_connection">
        <div class="connection">
            <form action="connexion.php" method="post">
                <label for="email">Email:</label> <input type="email" name="email" required> <br> <br>
                <label for="password">Mot de passe:</label> <input type="password" name="mdp" required> <br><br>
                <input type="submit" name="login" value="Connexion">
            </form>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
