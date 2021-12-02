<?php
declare(strict_types=1);

namespace app;
use DateTime;

class Utilitaires
{
    public static function convertirJour($id_jour):string{
        $jours = array('dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi');
        return $jours[$id_jour-1];
    }
    public static function convertirMois($id_mois):string{
        $mois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
        return $mois[intVal($id_mois)-1];
    }

    public static function chargerFichierJSON($fichier,$arr_assoc):array{
        $json=file_get_contents($fichier);
        $arr_json=json_decode($json,$arr_assoc);
        return $arr_json;
    }

    public static function validerChamp(string $nomChamp, string $motif,array $arr_messagesJSON, array $arr_validation, bool $bool_accepterValeurVide=false):array
    {
        $valeurPost = '';
        $valide = 'faux';
        $message = '';

        // Si le champ existe dans $_POST
        if(isset($_GET[$nomChamp])) {

            //Retirer les espaces du début et de la fin
            $valeurPost = trim($_GET[$nomChamp]);

            //if($_POST[$nomChamp] == '' && !$accepterValeurVideOuInexistant) { //Pas sûr si on vient de trimmer...
            //**********************************************************Michel Rouleau 30/10/2019
            if($valeurPost == '' && !$bool_accepterValeurVide) {
                // Si vide
                $message = $arr_messagesJSON[$nomChamp]['erreurs']['vide'];
            }else {
                // Si pas vide
                $trouve = preg_match($motif, $valeurPost);
                if (!$trouve) {
                    $message = $arr_messagesJSON[$nomChamp]['erreurs']['pattern'];
                }else{
                    $valide = 'vrai';
                }
            }
        }else{
            // Si le champ n'existe pas dans $_POST
            if($bool_accepterValeurVide){
                $valide = 'vrai';
            }else{
                $message = $arr_messagesJSON[$nomChamp]['erreurs']['vide'];
            }
        }
        $arr_validation[$nomChamp] = ['valeur' => $valeurPost, 'valide'=> $valide, 'message' => $message];
        return $arr_validation;
    }

    public static function validerGroupeBoutonRadio( $nomGroupBouton, $valeurDefaut, $arr_messagesJSON, $arr_validation, $bool_accepterValeurVide=false):array
    {
        var_dump($nomGroupBouton, $valeurDefaut,$arr_messagesJSON, $arr_validation, $bool_accepterValeurVide=false);
        $valeur = $valeurDefaut;
        $valide = 'faux';
        $message = '';

        // Si le groupe existe dans $_POST
        if(isset($_GET[$nomGroupBouton])) {
            //Si groupe présent dans $_POST
            //Valide
            $valide = 'vrai';
            $message = '';
            $valeur=$_GET[$nomGroupBouton];
        }else{
            // Si le groupe n'existe pas dans $_POST et pas obligatoire
            if($bool_accepterValeurVide){
                //Choix valide
                $valide = 'vrai';
                $message = '';
            }else{
                // Si pas dans $_POST et obligatoire, invalide
                $valide = 'faux';
                // Message d'erreur vide
                $message = $arr_messagesJSON[$nomGroupBouton]['erreurs']['vide'];
            }
        }
        $arr_validation[$nomGroupBouton] = ['valeur' => $valeur, 'valide'=> $valide, 'message' => $message];
        return $arr_validation;
    }

    public static function validerSelecteur(string $nomSelecteur , string $valeurDefaut, array $arr_messagesJSON, array $arr_validation):array
    {
        $valeur=$_GET[$nomSelecteur];
        $valide = 'faux';
        $message = '';

        if($valeur!==$valeurDefaut) {
            //Valide
            $valide = 'vrai';
            $message = '';
            $valeur=$_GET[$nomSelecteur];
        }else{

            $valide = 'faux';
            // Message d'erreur vide
            $message = $arr_messagesJSON[$nomSelecteur]['erreurs']['vide'];
        }

        $arr_validation[$nomSelecteur] = ['valeur' => $valeur, 'valide'=> $valide, 'message' => $message];
        return $arr_validation;
    }

    public static function validerDateEcheance(string $annee , string $mois, string $jour, array $arr_messagesJSON, array $arr_validation):array
    {
        if($_GET[$annee]!=="0" && $_GET[$mois]!=="0" && $_GET[$jour]!=="0"){
            if(checkdate(intVal($_GET[$mois]),intVal($_GET[$jour]),intVal($_GET[$annee]))){
                //Format date valide
                $dateButoir=new DateTime($_GET[$annee].'-'.$_GET[$mois].'-'.$_GET[$jour]);
                $aujourdhui=new DateTime();
                if($aujourdhui<$dateButoir){
                    //Pas expiré
                    $valide = 'vrai';
                    $message = '';
                }else{
                    //Expiré
                    $valide = 'faux';
                    $message = $arr_messagesJSON['echeance']['erreurs']['expire'];
                }
            }else{
                //Format de date impossible, genre 31 février
                $valide = 'faux';
                $message = $arr_messagesJSON['echeance']['erreurs']['motif'];
            }
        }else{
            if($_GET[$annee]==="0" && $_GET[$mois]==="0" && $_GET[$jour]==="0"){
                //Aucun des sélecteur est sélectionné (lorsqu'on veut pas d'échéance)
                $valide = 'vrai';
                $message = '';
            }else{
                //Un des sélecteurs n'a pas été sélectionné
                $valide = 'faux';
                $message = $arr_messagesJSON['echeance']['erreurs']['vide'];
            }
        }

        $arr_validation["expiration"] = ['annee' => $_GET[$annee], 'mois'=> $_GET[$mois], 'jour'=> $_GET[$jour], 'valide'=> $valide, 'message' => $message];
        return $arr_validation;
    }

}