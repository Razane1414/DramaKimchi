<?php
    include("config/config.php");
    session_start();
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nom_bd, $identifiant, $mot_de_passe, $options);


    // des genres pour le formulaire
    $requeteGenres = $bdd->query('SELECT GenreID, Nom FROM Genres');
    $genres = $requeteGenres->fetchAll(PDO::FETCH_ASSOC);


    // pour formulaire barre de recherche 
    if (!empty($_POST['rechercheTitre'])) {
        $rechercheTitre = '%' . $_POST['rechercheTitre'] . '%';
        $requete = 'SELECT * FROM Kdramas WHERE Titre LIKE ?';
        $requete_ = $bdd->prepare($requete);
        $requete_ ->execute([$rechercheTitre]);

    } elseif (!empty($_POST['GenreID'])) {
        // Traitement du filtrage par genre
        $genreID = (int)$_POST['GenreID'];
        $requete = 'SELECT kdramas.* FROM kdramas
                    JOIN kdramasgenres ON kdramas.KdramaID = kdramasgenres.KdramaID
                    WHERE kdramasgenres.GenreID = ?';
        $requete_ = $bdd->prepare($requete);
        $requete_->execute([$genreID]);

    } else {
        // afficher de tous les Kdramas si aucun filtre n'est appliqué
        $requete = 'SELECT * FROM Kdramas';
        $requete_ = $bdd->query($requete);
    }

    $tabdrama = $requete_->fetchAll(PDO::FETCH_ASSOC);



    $recommandations = [];

    // verif si l'utilisateur est co
    if (isset($_SESSION['UserID'])) {
        $userID = $_SESSION['UserID'];

        // recup des genres préférés de l'utilisateur
        $requeteGenresUtilisateur = $bdd->prepare("SELECT GenreID FROM UtilisateursGenres WHERE UserID = :userID");
        $requeteGenresUtilisateur->execute(['userID' => $userID]);
        $genresUtilisateur = $requeteGenresUtilisateur->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($genresUtilisateur)) {
            // genere une requête pour récupérer des Kdramas basés sur les genres préférés
            $in  = str_repeat('?,', count($genresUtilisateur) - 1) . '?';
            $requeteRecommandations = $bdd->prepare("SELECT DISTINCT kdramas.* FROM kdramas JOIN kdramasgenres ON kdramas.KdramaID = kdramasgenres.KdramaID WHERE kdramasgenres.GenreID IN ($in)");
            $requeteRecommandations->execute($genresUtilisateur);
            $recommandations = $requeteRecommandations->fetchAll(PDO::FETCH_ASSOC);
        }
}
?>


<body><?php include("navbar.php"); ?>

<div class="catalogue_page">
    <div class="recherche">
        <h1>CATALOGUE</h1>
        <!-- formulaire de recherche par titre -->
        <div class="barreRecherche">
            <form action="" method="POST">
                <div class="input-container"> <!-- Conteneur Flex pour input et bouton -->
                    <input type="text" name="rechercheTitre" placeholder="SEARCH">
                    <input type="submit" value="Go">
                </div>
            </form>
        </div>

        
    <!-- formulaire de filtrage par genre -->
    <div class="filtres">
        <form action="" method="POST" class="filtreGenre">
            <button type="submit" name="tousLesGenres" class="bouton_all_genres" <?= !isset($_POST['GenreID']) && isset($_POST['tousLesGenres']) ? 'selected' : ''; ?>">All</button>
            <?php foreach ($genres as $genre): ?>
                <button type="submit" name="GenreID" value="<?= $genre['GenreID']; ?>" class="bouton_genre" <?= isset($_POST['GenreID']) && $_POST['GenreID'] == $genre['GenreID'] ? 'selected' : ''; ?>">
                    <?= htmlspecialchars($genre['Nom']); ?>
                </button>
            <?php endforeach; ?>
        </form>
    </div>

    </div>

    <div class="catalogue-wrapper">
        <?php foreach($tabdrama as $tab): ?>
            <div class="catalogue-item">
                <a href="kdrama.php?kdramaID=<?php echo $tab["KdramaID"]; ?>">
                    <div class="image-container">
                        <img src="<?php echo $tab["Image"]; ?>" alt="Image de <?php echo $tab["Titre"]; ?>">
                        <div class="overlay">
                            <div class="text"><?php echo $tab["Titre"]; ?></div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>


    
    <?php if (!empty($recommandations)): ?>
        <div class="recommandation">
            <p>Recommandations basées sur vos genres préférés</p>
            <hr> <!-- Séparateur ajouté ici -->
            <div class="recommandation-grid">
                <?php foreach($recommandations as $recommandation): ?>
                    <div class="catalogue">
                        <a href="kdrama.php?kdramaID=<?php echo $recommandation["KdramaID"]; ?>">
                            <img src="<?php echo $recommandation["Image"]; ?>" alt="Image de <?php echo $recommandation["Titre"]; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include("footer.php"); ?>

