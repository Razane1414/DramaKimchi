<?php
    include("config/config.php");
    session_start(); ?>

<head>
    <title>Generateur-kdrama</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="generateur-kdrama">
        <div class="container_formulaire">
            <div class="texte_formulaire">
                <h1>Bienvenue ! <br> Plongez dans l'univers des K-dramas personnalisés, spécialement choisis selon vos goûts.</h1>
            </div>

            <!-- Retiré l'attribut method="POST" et le bouton de type submit -->
            <div class="formulaire">
                <div class="champs_nom">
                    Nom : <input type="text" id="nom" name="nom" >
                </div>

                <div class="champs_genre">
                    Quel est votre genre préféré ?<br>
                    <div class="gridGenre">
                        <div class="radio-container">
                            <input type="radio" id="genreRomance" name="genre" value="Romance">
                            <label for="genreRomance">Romance</label>
                        </div>
                        <div class="radio-container">
                            <input type="radio" id="genreAction" name="genre" value="Action">
                            <label for="genreAction">Action</label>
                        </div>
                        <div class="radio-container">
                            <input type="radio" id="genreMystere" name="genre" value="Mystere">
                            <label for="genreMystere">Mystère</label>
                        </div>
                        <div class="radio-container">
                            <input type="radio" id="genreComedie" name="genre" value="Comedie">
                            <label for="genreComedie">Comédie</label>
                        </div>
                        <div class="radio-container">
                            <input type="radio" id="genreThriller" name="genre" value="Thriller">
                            <label for="genreThriller">Thriller</label>
                        </div>
                        <div class="radio-container">
                            <input type="radio" id="genreFantastique" name="genre" value="Fantastique">
                            <label for="genreFantastique">Fantastique</label>
                        </div>
                    </div>
                </div>

                <!-- Utilise un bouton normal pour déclencher la fonction JavaScript -->
                <button id="bouton_ouvrir" onclick="popupFR()">Résultat</button>
            </div>
            <h3><span id="affichageRetour_Utilisateur"></span></h3>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>