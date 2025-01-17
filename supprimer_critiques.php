<?php
    include('config/config.php');
    session_start();



    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nom_bd, $identifiant, $mot_de_passe, $options);

    if (isset($_POST['CritiqueID']) && !empty($_POST['CritiqueID'])) {
        $critiqueID = $_POST['CritiqueID'];

        // suppression d'une critique
        $requete = $bdd->prepare('DELETE FROM Critiques WHERE CritiqueID = :critiqueID AND UserID = :userID');
        $nbsuppression = $requete->execute(['critiqueID' => $critiqueID, 'userID' => $_SESSION['UserID']]);

        header('Location: espace_membre.php?action=suppression&suppr=OK');
        exit(); }
?>