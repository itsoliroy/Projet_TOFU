/**
 * @file optionEcheance avec poignée (icone + screen-reader-text)
 * En respect des principes de l'amélioration progressive.
 * À compléter/ajuster selon vos besoins.
 * @author nomAuteur <adressecourriel>
 *
 */

var optionEcheance = {

    refOptionEcheance:$(".optionEcheance"),

    initialiser: function(){

        // Création du bouton qui sera ajouté à l'interface
        this.refOptionEcheance.prepend(
            '<button type="button" class="optionEcheance__controle btn">' +
            // '<span class="far fa-calendar-plus">&nbsp;</span>' +

            'Échéance' +

            '<span class="optionEcheance__controlePoignee">&nbsp;' +
            '<span class="icone fas fa-plus"></span>' +
            '<span class="visuallyhidden">Fermer</span>' +
                '</span>' +
            '</button>'
        );

        // Ajout de l'écouteur d'événement
        $(".optionEcheance__controle").on('click', this.afficherCacherBloc.bind(this));

        //Michel Rouleau 2021
        //***********************************
        var date=[this.refOptionEcheance.find("#jour").val(),this.refOptionEcheance.find("#mois").val(),this.refOptionEcheance.find("#annee").val()];




        //Si les trois sélecteurs sont activés, ouvrir la boîte
         if(date[0]!=='0' && date[1]!=='0' && date[2]!=='0' ){

             this.refOptionEcheance.closest('.optionEcheance').removeClass("optionEcheance--is-collapsed");
             this.refOptionEcheance.find('span.icone').removeClass("fa-plus");
             this.refOptionEcheance.find('span.icone').addClass("fa-minus");
             this.refOptionEcheance.find('.visuallyhidden').text("Fermer");
         }else{
             //S'il y a un message d'erreur afficher, ouvrir la boîte
             if(this.refOptionEcheance.find('.formulaire__erreur').text()!==""){

                 this.refOptionEcheance.closest('.optionEcheance').removeClass("optionEcheance--is-collapsed");
                 this.refOptionEcheance.find('span.icone').removeClass("fa-plus");
                 this.refOptionEcheance.find('span.icone').addClass("fa-minus");
                 this.refOptionEcheance.find('.visuallyhidden').text("Fermer");
             }else{
                //Autrement fermer la boîte
                this.resetBlocs();
             }
         }
        //this.resetBlocs();
        // ***********************************
    },

    resetBlocs: function(){
        // Ajout des classes nécessaires aux éléments pour l'état par défaut
        this.refOptionEcheance.addClass("optionEcheance--is-collapsed");
        //$(".optionEcheance__controlePoignee span.icone").removeClass("fa-minus");
        this.refOptionEcheance.find('span.icone').removeClass("fa-minus");
        this.refOptionEcheance.find('span.icone').addClass("fa-plus");
        //console.log('allo');
        $(".optionEcheance__controlePoignee .visuallyhidden").text("Ouvrir");
    },

    afficherCacherBloc: function(evenement){
        // Vérification de l'état de la boîte
        if ($(evenement.currentTarget).closest('.optionEcheance').hasClass("optionEcheance--is-collapsed")) {
            // Si la boîte est fermée, on ouvre
            this.resetBlocs();
            $(evenement.currentTarget).closest('.optionEcheance').removeClass("optionEcheance--is-collapsed");
            $(evenement.currentTarget).find('span.icone').removeClass("fa-plus");
            $(evenement.currentTarget).find('span.icone').addClass("fa-minus");
            $(evenement.currentTarget).find('.visuallyhidden').text("Fermer");
        }
        else {
            //Michel Rouleau 2021
           //*******************************
            //Remettre les valeurs de sélecteurs à 0
            this.refOptionEcheance.find("#jour").val("0");
            this.refOptionEcheance.find("#mois").val("0");
            this.refOptionEcheance.find("#annee").val("0");
            this.refOptionEcheance.find('.formulaire__erreur').text("")
            //*******************************
            // Si la boîte est ouverte, on ferme
            this.resetBlocs();
        }
    }

};

//*******************
// Écouteurs d'événements
//*******************
$(document).ready(optionEcheance.initialiser.bind(optionEcheance));


