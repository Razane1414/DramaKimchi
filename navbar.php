<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">


    <!-- LIENS EXTERNE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


</head>


<body>
    <script src="script.js"></script>
    <header>
        <div class="header-section left">
                <div id="themeControleur" class="icon-heart"><i class="fas fa-heart"></i></div>
        </div>
        <div class="header-section center">
            <a href="index.php" class="logo">
                <video loop muted class="logo-video" id="logoVideo">
                    <source src="images/logo.webm" type="video/webm">
                    Votre navigateur ne supporte pas les vidéos HTML5.
                </video>
            </a>
        </div>
        <div class="header-section right">
            <button class="hamburger" onclick="toggleFullscreenNav()">&#9776;</button>
            <ul> 
                <li><a href="catalogue.php">CATALOGUE</a></li>
                <li><a href="generateurDrama.php">QUIZ</a></li>
                <li>
                    <?php if(isset($_SESSION['UserID'])): ?>
                        <a href="espace_membre.php"><i class="fas fa-user fa-2x"></i></a>
                    <?php else: ?>
                        <a href="connexion.php"><i class="fas fa-user fa-2x"></i></a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </header>
    
    <div class="fullscreen-nav" id="fullscreenNav">
        <button id="close-btn">&#10005;</button>
        <ul> 
            <li><a href="catalogue.php">CATALOGUE</a></li>
            <li><a href="generateurDrama.php">QUIZ</a></li>
            <li>
                <?php if(isset($_SESSION['UserID'])): ?>
                    <a href="espace_membre.php"><i class="fas fa-user fa-2x"></i></a>
                <?php else: ?>
                    <a href="connexion.php"><i class="fas fa-user fa-2x"></i></a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</body>
</html>