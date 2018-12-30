
/* HEADER, RENDU DU MENU DEROULANT */


/* VARIABLES */

/* le titre "MENU" pour la version mobile */
var title = document.getElementById('menu-toggle');
/* l'intégralité du menu */
var nav = document.getElementById('nav-toggle');
/* les sous-menus */
var publications = document.getElementById('publications-menu');
var novels = document.getElementById('novels-menu');
var press = document.getElementById('press-menu');
var actu = document.getElementById('actu-menu');

/* pour faire une rotation sur les "+" des menus déroulants (version mobile) */
var publiplus =  document.getElementById('publi-plus');
var novelplus =  document.getElementById('novel-plus');
var pressplus =  document.getElementById('press-plus'); 
var actuplus =  document.getElementById('actu-plus');



/* FONCTIONS */

/* fonction pour afficher / masquer des éléments du menu */
function toggleMenu(p) {
    p.classList.toggle('fold'); // élément caché
    p.classList.toggle('unfold'); // élément déroulé
}

function togglePlus(p) {
    p.classList.toggle('notrotate'); // rotation
    p.classList.toggle('rotate'); // rotation
    
}


/* fonction pour afficher correctement lorsqu'on est sur mobile ou qu'on change de résolution */
function resizeOnMobile() {
    /* affichage du "MENU" cliquable pour dérouler le menu */
    title.classList.remove('fold');
    title.classList.add('unfold');

    /* le  menu entier est à cacher / afficher */
    /* listener pour le menu "hamburger" */
    nav.classList.remove('unfold');
    nav.classList.add('fold');
    document.getElementById('menu-toggle').addEventListener('click', function(){toggleMenu(nav)});

    /* listeners pour les sous-menus */
    publications.classList.add('fold');
    novels.classList.add('fold');
    press.classList.add('fold');
    if (actu) {
        actu.classList.add('fold');
    }
    
    /* pour déclencher l'affichage des sous menus */
    document.getElementById('publications-toggle').addEventListener('click', function(){toggleMenu(publications)});
    document.getElementById('novels-toggle').addEventListener('click', function(){toggleMenu(novels)});
    document.getElementById('press-toggle').addEventListener('click', function(){toggleMenu(press)});
    if (actu) {
        document.getElementById('actu-toggle').addEventListener('click', function(){toggleMenu(actu)});
    }
    

    /* pour déclencher la rotation des petits "+" lorsqu'un sous-menu est déroulé */
    document.getElementById('publications-toggle').addEventListener('click', function(){togglePlus(publiplus)});
    document.getElementById('novels-toggle').addEventListener('click', function(){togglePlus(novelplus)});
    document.getElementById('press-toggle').addEventListener('click', function(){togglePlus(pressplus)});
    if (actu) {
        document.getElementById('actu-toggle').addEventListener('click', function(){togglePlus(actuplus)});
    }
    
}


/* fonction pour afficher correctement lorsqu'on est sur ordi ou qu'on change de résolution */
function resizeOnPc() {

     /* on cache le "MENU" */
     title.classList.remove('unfold');
     title.classList.add('fold');

     /* on affiche le menu déroulant */
     nav.classList.remove('fold');
     nav.classList.add('unfold');

     /* on rend visible les sous-menus pour les :hover en css */
     publications.classList.remove('fold');
     novels.classList.remove('fold');
     press.classList.remove('fold');
     if (actu) {
        actu.classList.remove('fold');
    }
}



/* LISTENERS pour changer la taille de l'écran */


var mobileDevice = window.matchMedia("(max-width: 1023px)");
var pcDevice = window.matchMedia("(min-width: 1024px)");


if (matchMedia) {
    mobileDevice.addListener(screenChange);
    screenChange(mobileDevice);
}

/* changement d'affichage "dynamique" lorsqu'on redimentionne un écran */
function screenChange(p) {
    if (p.matches) {
        resizeOnMobile();
    } else {
        resizeOnPc();  
    }
}






