/**
 * @file barreOnglets
 * @author Ève Février
 * @author Yves Hélie
 * @author nomEtudiant <courrielEtudiant>
 * @version 1.0 - avec jQuery
 */

//*******************
// Déclaration d'objet
//*******************
var barreOnglets = {

    initialiser: function(){
        this.reset();
        $(".barreOnglets__controle").on('click', this.afficherCacher.bind(this));
    },
    reset: function(){
        $('.barreOnglets__onglet').addClass('barreOnglets__onglet--invisible');
    },
    afficherCacher: function (evenement) {
        evenement.preventDefault();
        console.log('afficherCacher');
        var $segmentCible = $(evenement.currentTarget).closest('.barreOnglets__onglet');
        if ($segmentCible.hasClass('barreOnglets__onglet--invisible')) {
            this.reset();
            $segmentCible.removeClass('barreOnglets__onglet--invisible');
        }
        else {
            this.reset();
        }
    }

};