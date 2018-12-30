
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


/* FONCTIONS */

/* fonction pour afficher / masquer des éléments du menu */
function toggleMenu(p) {
    p.classList.toggle('fold'); // élément caché
    p.classList.toggle('unfold'); // élément déroulé
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
    document.getElementById('publications-toggle').addEventListener('click', function(){toggleMenu(publications)});
    document.getElementById('novels-toggle').addEventListener('click', function(){toggleMenu(novels)});
    document.getElementById('press-toggle').addEventListener('click', function(){toggleMenu(press)});
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
}



/* LISTENERS */

/* affichage initial de la page, détection du format d'écran */
document.addEventListener('DOMContentLoaded', function(){
    if (window.matchMedia("(max-width: 1023px)").matches) {
        resizeOnMobile();
        } 
    else if (window.matchMedia("(min-width: 1024px)").matches) {
        resizeOnPc();
        };
    });

/* changement d'affichage "dynamique" lorsqu'on redimentionne un écran *//*
window.addEventListener('resize', function(){
    if (window.matchMedia("(max-width: 1023px)").matches) {
        resizeOnMobile();
        }
    else if (window.matchMedia("(min-width: 1024px)").matches) {
        resizeOnPc();
        };
    });*/







