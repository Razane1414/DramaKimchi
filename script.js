
                                            // CHANGEMENT DE THEME EN JS
// Il s'agit d'une fonction qui permet de changer le theme de couleur afin de passer de la couleur iniale (rose) 
// à la couleur alternative (bleu) 
function changementTheme() {
    // pour suivre si le thème est actuellement activé
    let themeAlternatifActif = document.body.classList.contains('theme-alternatif');

    if (themeAlternatifActif) {
        // Retour au thème initial
        document.body.classList.remove('theme-alternatif');
    } else {
        // Appliquer le thème alternatif
        document.body.classList.add('theme-alternatif');
    }
}

// abonnement pour qu'au click de l'icone (themecontroleur) appliquer le changement de theme
function SetupListenersThemeFR() {
    let boutonthemeFR = document.getElementById("themeControleur");
    boutonthemeFR.addEventListener("click", changementTheme);
}

window.addEventListener('load', SetupListenersThemeFR);




                                                                // POUR LE MENU BURGER  


// Fonction pour l'affichage du menu en plein écran du menu burger
function toggleFullscreenNav() {
    document.getElementById('fullscreenNav').classList.toggle('active');
}

// Fermeture du menu plein écran
function closeFullscreenFR() {
    document.getElementById('fullscreenNav').classList.remove('active');
}

// Configuration des écouteurs d'événements
function SetupListenersCloseFullScreenFR() {
    // si le bouton fermé est clické alors on ferme le plein ecrant grace à la fonction precedente
    let bouton_ferme = document.getElementById("close-btn");
    if (bouton_ferme) {
        bouton_ferme.addEventListener('click', closeFullscreenFR);
    }
}

// abonnement des evenement pour le redimensionnement de la fenêtre
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        closeFullscreenFR();
    }
});

// verification que le DOM est completement chargé avant de de proceder à l'appel des fonctins
document.addEventListener('DOMContentLoaded', function() {
    SetupListenersCloseFullScreenFR();
});


                                                    // ANIMATION LOGO AU HOVER

// fonction qui prepare l'animation, verifie qu'elle est en pause et reinitialise au début
function setupVideoStart() {
    logoVideoFR.pause(); // met la video en pause
    logoVideoFR.currentTime = 0; // s'assure qu'elle est au debut
}

// fonction pour jouer la video
function playVideoFR(){
    logoVideoFR.play(); 
}

// fonction pour metttre en pause la video
function PauseVideoFR() {
    logoVideoFR.pause(); 
    logoVideoFR.currentTime = 0; // remet la video a son debut
}

function SetupListenersVideoFR() {
    logoVideoFR = document.getElementById('logoVideo'); // recupere l'element video par son id
    // joue la video au survol
    logoVideoFR.addEventListener('mouseover', playVideoFR);
    
    // stop la video en dehors du survol
    logoVideoFR.addEventListener('mouseout', PauseVideoFR); 
}

window.addEventListener('load', SetupListenersVideoFR); // configure les ecouteurs d'evenements apres le chargement de la page


                                                    
                                                    // CAROUSELLE IMAGE 


// initialisation de l'index pour naviguer dans le tableau d'images
let indexFR = 0; 
// variable pour stocker l'ID du timer du défilement automatique
let IdTImer; 

// tableau contenant les chemins des images du carrousel
let tableau_imageFR = ["images/1.png", "images/2.png", "images/3.png"]

// fonction qui gère le défilement automatique des images
function defilementTempsFR() {
    // recup où afficher l'image du carrousel
    let zone_carouselleFR = document.getElementById('zone_carouselle');
    // met à jour la source de l'image avec l'image du tableau
    zone_carouselleFR.src= tableau_imageFR[indexFR];
    // incrémente l'index pour passer à l'image suivante
    indexFR = indexFR + 1;
    // si l'index dépasse la taille du tableau, le réinitialise à 0 pour boucler
    if (indexFR >= tableau_imageFR.length) {
        indexFR = 0;
    }
}

// fonction pour demarrer ou redemarrer le défilement automatique (exploitation de l'idTimer sans passer par un bouton pause !)
function boucleTempsFR(){
    // arrête tout défilement automatique en cours pour éviter les doublons
    clearInterval(IdTImer); 
    // démarre un nouveau défilement automatique toutes les 3 secondes
    IdTImer = setInterval(defilementTempsFR, 3000); 
}

// fonction pour passer à l'image précédente manuellement
function defilementPrecedentFR() {
    // arrête le défilement automatique
    clearInterval(IdTImer); 

    indexFR = indexFR - 1;
    // si l'index est inférieur à 0, le réinitialise au dernier élément du tableau afin de bien boucler
    if (indexFR < 0) {
        indexFR = tableau_imageFR.length - 1;
    }
    // met à jour l'image du carrousel
    document.getElementById('zone_carouselle').src = tableau_imageFR[indexFR];
    // redémarre le défilement automatique
    boucleTempsFR(); 
}

// fonction pour passer à l'image suivante manuellement
function defilementSuivantFR() {
    clearInterval(IdTImer);
    indexFR = indexFR + 1;
    if (indexFR >= tableau_imageFR.length) {
        indexFR = 0;
    }
    document.getElementById('zone_carouselle').src = tableau_imageFR[indexFR];
    boucleTempsFR();
}

// configuration des abonnement pour les boutons précédent et suivant
function SetupListenersFR(){
    // recuperation du bouton précédent et lui attache un écouteur pour le clic
    let precedentFR = document.getElementById('precedent');
    precedentFR.addEventListener('click', defilementPrecedentFR);

    // recuperation du bouton suivant et lui attache un écouteur pour le clic
    let suivantFR = document.getElementById('suivant');
    suivantFR.addEventListener('click', defilementSuivantFR);
}

//au chargement de la page attache d'evenement
window.addEventListener('load', function() {
    // affiche immédiatement la première image (pour eviter d'attendre 3sec) et démarre le défilement automatique
    defilementTempsFR(); 
    boucleTempsFR();
    // configure les écouteurs pour les boutons de navigation
    SetupListenersFR();
});






                                                                // RECOMMANDATION PAGE POPUP

// initialisation globale de la variable pour stocker la référence à la page popup
let popupPageFR;

// bibliothèque d'images de Kdrama classées par genre
let kdramasImagesFR = {
    "Romance": [
        "images/business_proposal.jpg",
        "images/crash_landing_on_you.jpg",
    ],
    "Action": [
        "images/la_traque_dans_le_sang.jpg",
        "images/my_name.jpg",
    ],
    "Mystere": [
        "images/the_glory.jpg",
        "images/signal.jpg",
    ],
    "Comedie": [
        "images/weightlifting_fairy_kim_bok_joo.jpg",
        "images/true_beauty.webp",
    ],
    "Thriller": [
        "images/extracurricular.jpg",
        "images/the_penthouse_war_in_life.jpg",
    ],
    "Fantastique": [
        "images/demon_catchers.jpg",
        "images/all_of_us_are_dead.png",
    ]
};

// fonction pour ouvrir la popup et stocker la référence
function popupFR() {
    // récupère le genre sélectionné par l'utilisateur
    let genreSelectionneFR = document.querySelector('input[name="genre"]:checked')?.value;
    if (!genreSelectionneFR) {
        alert("Veuillez sélectionner un genre."); // affiche une alerte si aucun genre n'est sélectionné
    } else {
        // pour ouvrir une nouvelle fenêtre popup avec des dimentions 
        popupPageFR = window.open("popupPage.html", "", "width=600,height=400");
    }
}

// fonction pour fermer la popup
function fermer_fenetreFR() {
    window.close();
}

// fonction pour remplir la page popup avec les informations nécessaires
function informerPopupCreeFR() {
    if (window.opener) {
        // récupère le nom entré par l'utilisateur dans la page mère
        let nomFR = window.opener.document.getElementById('nom').value;
        // affiche le nom dans la popup
        document.getElementById("affichagePrenom").textContent = nomFR;

        // récupère le genre sélectionné dans la page mère
        let genreSelectionneFR = window.opener.document.querySelector('input[name="genre"]:checked')?.value;
        // affiche le genre dans la popup
        document.getElementById('affichageGenre').textContent = genreSelectionneFR;

        // sélectionne au hasard une image en fonction du genre choisi
        let imagesFR = kdramasImagesFR[genreSelectionneFR];
        let imageChoisieFR = imagesFR[Math.floor(Math.random() * imagesFR.length)];    
        // met à jour la source de l'image dans la popup
        document.getElementById('kdramaImage').src = imageChoisieFR;
    }
}

// textes de retour selon la réponse de l'utilisateur dans la popup
retourOuiFR = "Vous l'avez donc déjà vu ? Pas de problème, essayez de générer un nouveau drama aléatoire !";
retourNonFR = "Génial ! Un nouveau Drama à ajouter à votre liste, bon visionnage !";

// fonction pour remplir le champ de retour dans la page mère selon la réponse de l'utilisateur dans la popup
function remplirChampRetourPopup(retourOuiFR, retourNonFR){
    let retourUtilisateurFR = document.getElementById("retour_utilisateur");
    if (retourUtilisateurFR.value == 'Oui'){
        // accède au document de la page mère pour mettre à jour le texte de retour
        window.opener.document.getElementById('affichageRetour_Utilisateur').textContent = retourOuiFR;
    } else {
        window.opener.document.getElementById('affichageRetour_Utilisateur').textContent = retourNonFR;
    }
}

// configuration des écouteurs d'événements
function setupEventListenersPop() {
    // ajoute un écouteur sur le bouton d'ouverture de popup
    let bouton_ouvrirFR = document.getElementById('bouton_ouvrir');
    if (bouton_ouvrirFR) {
        bouton_ouvrirFR.addEventListener('click', popupFR);
    }

    // ajoute un écouteur sur le bouton de fermeture de popup
    let bouton_fermerFR = document.getElementById('fermer');
    if (bouton_fermerFR) {
        bouton_fermerFR.addEventListener('click', function() {
            remplirChampRetourPopup(retourOuiFR, retourNonFR); // met à jour le texte de retour dans la page mère
            fermer_fenetreFR(); // ferme la popup
        });
    }

    // remplit la popup avec les informations nécessaires si elle est ouverte depuis la page mère
    if (window.opener) {
        informerPopupCreeFR();
    }
}

// ajoute un écouteur pour configurer les écouteurs d'événements après le chargement de la page
window.addEventListener('load', setupEventListenersPop);



                                                            // WATCH LIST K-DRAMA (TO-DO liste)

// fonction pour ajouter une tache
function ajouterTacheFR() {
    // recupere le champ ou l'utilisateur entre le nom du k-drama
    let champTacheFR = document.getElementById('toWatch');
    // verifie si le champ est vide
    if (champTacheFR.value === "") {
        alert("Veuillez entrer le nom d'un k-drama à ajouter."); // affiche une alerte si le champ est vide
        champTacheFR.focus(); // remet le focus sur le champ pour entrer un nom
    } else {
        // cree un nouvel element de liste
        let liFR = document.createElement('li');
        // cree une nouvelle etiquette
        let labelFR = document.createElement('label');
        labelFR.innerText = champTacheFR.value; // definit le texte de l'etiquette avec la valeur entree
        liFR.appendChild(labelFR); // ajoute l'etiquette au nouvel element de liste

        // cree un nouveau bouton pour la suppression
        let boutonSuppressionFR = document.createElement('button');
        boutonSuppressionFR.innerText = 'Supprimer'; // definit le texte du bouton
        liFR.appendChild(boutonSuppressionFR); // ajoute le bouton au nouvel element de liste

        // recupere la liste ul où ajouter le nouvel element li
        let ulFR = document.getElementById('listeDrama');
        ulFR.appendChild(liFR); // ajoute le nouvel element de liste à la liste

        champTacheFR.value = ''; // reinitialise le champ d'entrée
        // ajoute un ecouteur d'evenement sur le bouton pour supprimer la tache
        boutonSuppressionFR.addEventListener('click', supprimerTacheFR);
    }
}

// fonction pour supprimer une tache
function supprimerTacheFR() {
    // "this" pour faire reference au bouton qui a declenche l'evenement, donc son parent est le li à supprimer
    let liFR = this.parentElement;
    // le parent du li est le ul qui contient la liste
    let ulFR = liFR.parentElement;
    // supprime le li du ul
    ulFR.removeChild(liFR);
}

// configuration des ecouteurs d'evenements
function setupEventListenersTodoFR() {
    // recupere le bouton pour ajouter une tache à la liste
    let boutonToWatchFR = document.getElementById('bouton_watchlist');
    // ajoute un ecouteur d'evenement sur le bouton pour executer ajouterTacheFR quand il est cliqué
    boutonToWatchFR.addEventListener('click', ajouterTacheFR);
}

// ajoute un ecouteur d'evenement au chargement de la fenetre pour configurer les ecouteurs d'evenements
window.addEventListener('load', setupEventListenersTodoFR);
