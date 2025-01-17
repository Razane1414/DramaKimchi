<?php
    session_start();
    include("config/config.php");

    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nom_bd, $identifiant, $mot_de_passe, $options);

    // requête d'insertion
    $requete_preparee = $bdd->prepare('INSERT INTO Critiques (UserID, KdramaID, Texte, Note, DatePost) VALUES (:userID, :kdramaID, :texte, :note, NOW())');

    // liee les paramètres
    $requete_preparee->bindValue(':userID', $_SESSION['UserID'], PDO::PARAM_INT);
    $requete_preparee->bindValue(':kdramaID', $_POST['kdramaID'], PDO::PARAM_INT);
    $requete_preparee->bindValue(':texte', $_POST['texte'], PDO::PARAM_STR);
    $requete_preparee->bindValue(':note', $_POST['note'], PDO::PARAM_INT);

    // execute
    $resultat = $requete_preparee->execute();

    //  vers la page du Kdrama avec un message de succès ou d'erreur
    if ($resultat) {
        header('Location: kdrama.php?kdramaID=' . $_POST['kdramaID'] . '&message=success');
    } else {
        header('Location: kdrama.php?kdramaID=' . $_POST['kdramaID'] . '&message=error');
    }
    exit();
?>
