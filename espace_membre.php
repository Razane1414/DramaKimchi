<?php
    include('config/config.php');
    session_start();

    $bdd = new PDO("mysql:host=$hote;dbname=$nom_bd", $identifiant, $mot_de_passe);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userID = $_SESSION['UserID'];

    // informations de l'utilisateur
    $requeteUtilisateur = $bdd->prepare("SELECT * FROM Utilisateurs WHERE UserID = :userID");
    $requeteUtilisateur->execute(['userID' => $userID]);
    $utilisateur = $requeteUtilisateur->fetch(PDO::FETCH_ASSOC);

    // tous les genres disponibles
    $requeteGenres = $bdd->prepare("SELECT * FROM Genres ORDER BY Nom");
    $requeteGenres->execute();
    $genresDisponibles = $requeteGenres->fetchAll(PDO::FETCH_ASSOC);

    // les genres préférés de l'utilisateur
    $requeteGenresUtilisateur = $bdd->prepare("SELECT GenreID FROM UtilisateursGenres WHERE UserID = :userID");
    $requeteGenresUtilisateur->execute(['userID' => $userID]);
    $genresUtilisateur = $requeteGenresUtilisateur->fetchAll(PDO::FETCH_COLUMN, 0);

    // les critiques de l'utilisateur
    $requeteCritiques = $bdd->prepare("SELECT Critiques.*, Kdramas.Titre FROM Critiques JOIN Kdramas ON Critiques.KdramaID = Kdramas.KdramaID WHERE Critiques.UserID = :userID ORDER BY Critiques.DatePost DESC");
    $requeteCritiques->bindParam(':userID', $userID, PDO::PARAM_INT);
    $requeteCritiques->execute();
    $critiques = $requeteCritiques->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <?php include("navbar.php"); ?>

    <main class="espace_membre">
        <?php if ($utilisateur): ?>
        <div class="container">
            <div class="top_membre">
                <img class="profile-image" src="images\userIcone.jpeg" alt="Profil">
                <h1>Bienvenue, <?php echo htmlspecialchars($utilisateur['NomUtilisateur']); ?>!</h1>
            </div>
            
            <div class="infos_perso">
                <h2>Mes infos personnelles</h2>
                <form action="modifier_infoperso.php" method="POST">
                    <div class="form-group">
                        <label for="NomUtilisateur">Nom d'utilisateur :</label>
                        <input type="text" name="NomUtilisateur" value="<?php echo htmlspecialchars($utilisateur['NomUtilisateur']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="Email">E-mail :</label>
                        <input type="email" name="Email" value="<?php echo htmlspecialchars($utilisateur['Email']); ?>">
                    </div>
                    
                    <fieldset class="genre_pref">
                        <legend>Genres préférés :</legend>
                        <?php foreach ($genresDisponibles as $genre): ?>
                            <div class="checkbox-container">
                                <input type="checkbox" name="genres[]" value="<?php echo $genre['GenreID']; ?>" <?php echo in_array($genre['GenreID'], $genresUtilisateur) ? 'checked' : ''; ?>>
                                <label><?php echo $genre['Nom']; ?></label>
                            </div>
                        <?php endforeach; ?>
                        <input type="hidden" name="UserID" value="<?php echo $utilisateur['UserID']; ?>">
                        <button type="submit" name="modifier" class="btn">Modifier</button>
                    </fieldset>
                    

                </form>
            </div>
            
            <div class="avis">
                <h2>Mes avis</h2>
                <?php foreach ($critiques as $critique): ?>
                    <article class="critique">
                        <h3><?php echo htmlspecialchars($critique['Titre']); ?></h3>
                        <p>Note: <?php echo htmlspecialchars($critique['Note']); ?></p>
                        <p><?php echo htmlspecialchars($critique['Texte']); ?></p>
                        <p>Date de publication: <?php echo htmlspecialchars($critique['DatePost']); ?></p>
                        <form action="supprimer_critiques.php" method="POST">
                            <input type="hidden" name="CritiqueID" value="<?php echo $critique['CritiqueID']; ?>">
                            <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                        </form>
                    </article>
                <?php endforeach; ?>
            </div>
            
            <div class="watchList">
                <h2>Ma Watch liste k-drama</h2>
                <input type="text" placeholder="Nom du k-drama" id="toWatch">
                <button id="bouton_watchlist" class="btn">Ajouter</button>
                <ul id="listeDrama"></ul>
            </div>




            <a href="deconnexion.php" class="deconnexion"><i class="fas fa-door-open"></i> Déconnexion</a>

        </div>
        
        
        <?php else: ?>
            <p>Utilisateur non trouvé.</p>
        <?php endif; ?>
        
    </main>

    <?php include("footer.php"); ?>
</body>
