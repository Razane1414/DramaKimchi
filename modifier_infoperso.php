<?php
    include("config/config.php");
    session_start();

    $id = $_SESSION['UserID'];
    $nomUtilisateur = $_POST['NomUtilisateur'];
    $email = $_POST['Email'];
    $genres = isset($_POST['genres']) ? $_POST['genres'] : [];

    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nom_bd, $identifiant, $mot_de_passe, $options);

    // update du NomUtilisateur et Email
    $requete = $bdd->prepare('UPDATE Utilisateurs SET NomUtilisateur=:NomUtilisateur, Email=:Email WHERE UserID=:id');
    $requete->execute([':NomUtilisateur' => $nomUtilisateur, ':Email' => $email, ':id' => $id]);

    // supp des genres préférés existants
    $requeteSuppressionGenres = $bdd->prepare('DELETE FROM UtilisateursGenres WHERE UserID = :id');
    $requeteSuppressionGenres->execute([':id' => $id]);

    // Ajout des nouveaux genres préférés
    foreach ($genres as $genreID) {
        $requeteInsertionGenre = $bdd->prepare('INSERT INTO UtilisateursGenres (UserID, GenreID) VALUES (:id, :genreID)');
        $requeteInsertionGenre->execute([':id' => $id, ':genreID' => $genreID]);
    }

    header('Location: espace_membre.php?miseajour=success');
    exit;
?>
