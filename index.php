<?php
    session_start();
?>
<body>
    <section class="accueil">
        <?php include("navbar.php"); ?>
            <div class="accueil_container">
                <div class="left_text">
                    <p>Plongez au cœur <br> des Kdramas</p>  
                    <a href="catalogue.php" class="bouton_catalogue">CATALOGUE</a>  
                </div>
                

                <div class="right_content">
                    <div class="image_carouselle">
                        <a href="catalogue.php"><img id="zone_carouselle" src="images/1.png" alt=""></a>
                    </div>
                    <div class="carouselle_controls">
                            <button id="precedent"><i class="fas fa-chevron-left"></i></button>
                            <button id="suivant"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
    </section>  
</body>
