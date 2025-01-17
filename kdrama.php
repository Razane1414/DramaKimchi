<?php
    include("config/config.php");
    session_start();

    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nom_bd, $identifiant, $mot_de_passe, $options);

    if (isset($_GET['kdramaID']) && !empty($_GET['kdramaID'])) {
        $kdramaID = htmlspecialchars($_GET['kdramaID']);
        
        // informations du Kdrama
        $requeteKdrama = 'SELECT * FROM Kdramas WHERE KdramaID = ?';
        $stmtKdrama = $bdd->prepare($requeteKdrama);
        $stmtKdrama->execute(array($kdramaID));
        $kdrama = $stmtKdrama->fetch(PDO::FETCH_ASSOC);
        
        // requête pour les genres
        $requeteGenres = 'SELECT G.Nom FROM Genres G
                        JOIN KdramasGenres KG ON G.GenreID = KG.GenreID
                        WHERE KG.KdramaID = ?';
        $stmtGenres = $bdd->prepare($requeteGenres);
        $stmtGenres->execute(array($kdramaID));
        $genres = $stmtGenres->fetchAll(PDO::FETCH_ASSOC);

        // pour récupérer les critiques liées au Kdrama
        $requeteCritiques = 'SELECT * FROM Critiques 
        JOIN Utilisateurs ON Critiques.UserID = Utilisateurs.UserID
        WHERE Critiques.KdramaID = ? 
        ORDER BY Critiques.DatePost DESC';
        $resCritiques = $bdd->prepare($requeteCritiques);
        $resCritiques->execute(array($kdramaID));
        $critiques = $resCritiques->fetchAll(PDO::FETCH_ASSOC);
    }
?>



<body>
    
    <?php include("navbar.php"); ?>

    <div class="container page_kdrama">
        <section class="kdrama_header">
            <!-- Titre déplacé au-dessus de l'image -->
            <h1><?= $kdrama['Titre']; ?></h1>
            <img src="<?= $kdrama['Image']; ?>" alt="Image de <?= $kdrama['Titre']; ?>" class="kdrama_thumbnail">
        </section>

        <section class="kdrama_details">
            <h2>Détails</h2>
            <p><strong>Date de sortie:</strong> <?= $kdrama['AnneeSortie']; ?></p>
            <p><strong>Genres:</strong> <?= implode(", ", array_column($genres, 'Nom')); ?></p>
            <p><strong>Synopsis:</strong> <?= $kdrama['Synopsis']; ?></p>
        </section>
        
        <section class="critiques_section">
            <h2>Critiques</h2>
            <?php foreach ($critiques as $critique): ?>
                <article class="critique">
                    <p><strong><?= $critique['NomUtilisateur']; ?></strong> (<?= $critique['DatePost']; ?>)</p>
                    <p><?= $critique['Texte']; ?></p>
                    <p>Note : <?= $critique['Note']; ?>/10</p>
                </article>
            <?php endforeach; ?>
        </section>
        
        <?php if(isset($_SESSION['UserID'])): ?>
            <section class="ajout_critique_form">
                <h2>Ajouter une critique</h2>
                <form action="ajout_critique.php" method="post">
                    <input type="hidden" name="kdramaID" value="<?= $kdramaID; ?>">
                    <label for="texte">Votre critique :</label>
                    <textarea name="texte" required placeholder="Écrivez votre critique ici"></textarea>
                    <label for="note">Note :</label>
                    <select name="note">
                        <?php for($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <input type="submit" value="Soumettre">
                </form>
            </section>
        <?php else: ?>
            <p class="login-reminder">Pour ajouter une critique, <a href="connexion.php">connectez-vous</a> à votre compte.</p>
        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>

</body>
</html>
