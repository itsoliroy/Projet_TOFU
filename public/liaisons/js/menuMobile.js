/**
 * @file un menu simple, responsive bâti en amélioration progressive et selon l'approche BEM.
 * @author Ève Février
 * @author nomEtudiant <courrielEtudiant>
 * @version 1.0 - avec jquery
 */

//*******************
// Déclaration d'objet
//*******************
var menuMobile = {
    lblMenuFerme: '<i class="fas fa-bars"></i> Menu',
    lblMenuOuvert: '<i class="fas fa-times"></i> Fermer',
    $menu: $('.menu--mobile'),

    initialiser: function () {
        //Ajout du bouton dans l'entête de la page html
        this.$menu.prepend('<button class="menu__controle btn">' + this.lblMenuFerme + '</button>');
        // Ajout de la classe pour cacher le menu
        this.$menu.addClass('menu--ferme');
        //Ajout de l'écouteur d'événement sur le bouton du menu
        $(".menu__controle").on('click',this.ouvrirFermerNav.bind(this));
    },

    ouvrirFermerNav: function () {
        // On bascule la classe de fermeture du menu
        this.$menu.toggleClass("menu--ferme");
        // On change le libellé du bouton selon l'état du menu
        if (this.$menu.hasClass("menu--ferme"))
        {
            $(".menu__controle").html(this.lblMenuFerme);
        } else
        {
            $(".menu__controle").html(this.lblMenuOuvert);
        }
    }
};