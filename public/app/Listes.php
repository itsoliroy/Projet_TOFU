<?php
declare(strict_types=1);

namespace app;
use DateTime;

class Listes
{

    private $str_titrePage = "";
    private $aujourdhui = null;
    private $obj_donnees = null;
    private $arr_listes = null;
    private $arr_couleurs = null;
    private $arr_messages = null;
    private $arr_liste = null;
    private $arr_validations = null;


    public function __construct($obj_mod)
    {
        $this->obj_donnees=$obj_mod;

        $this->arr_messages=Utilitaires::chargerFichierJSON("liaisons/js/objJSONMessages.json", true);
        //var_dump($this->arr_messages);
    }

	public function afficher()
    {
		echo "afficher listes";

        include_once("liaisons/fragments/header.inc.php");
        include_once ("liaisons/fragments/contenuhaut.inc.php");

        include_once ("liaisons/fragments/contenubas.inc.php");
        include_once("liaisons/fragments/footer.inc.php");
    }

    public function afficherAjouter():void{
//        echo "listes afficherAjouter";
        if(isset($_GET['validation'])){
            $this->arr_validations=unserialize($_GET['validation']);

            $this->arr_liste['nom']=$this->arr_validations['nom_liste']["valeur"];
            $this->arr_liste['couleur_id']=$this->arr_validations['couleur_id']["valeur"];
        }

        $this->str_titrePage="Ajouter une liste";

        $this->arr_listes = $this->obj_donnees->trouverListes();

        $this->arr_couleurs = $this->obj_donnees->trouverCouleurs();

        include_once("liaisons/fragments/header.inc.php");
        include_once ("liaisons/fragments/contenuhaut.inc.php");

        include_once ("liaisons/fragments/ajouterModifierListe.inc.php");

        include_once ("liaisons/fragments/contenubas.inc.php");
        include_once("liaisons/fragments/footer.inc.php");

    }

    public function afficherModifier($id_liste){

        if(isset($_GET['validation'])){
            $this->arr_validations=unserialize($_GET['validation']);

            $this->arr_liste['nom']=$this->arr_validations['nom_liste']["valeur"];
            $this->arr_liste['couleur_id']=$this->arr_validations['couleur_id']["valeur"];
        }

        $this->arr_listes = $this->obj_donnees->trouverListes();

        $this->arr_liste = $this->obj_donnees->trouverUneListe($id_liste);

        $this->str_titrePage="Modifier une liste";

        $this->arr_couleurs = $this->obj_donnees->trouverCouleurs();

        //var_dump($this->arr_liste);

        include_once("liaisons/fragments/header.inc.php");
        include_once ("liaisons/fragments/contenuhaut.inc.php");

        include_once ("liaisons/fragments/ajouterModifierListe.inc.php");

        include_once ("liaisons/fragments/contenubas.inc.php");
        include_once("liaisons/fragments/footer.inc.php");

    }

    public function ajouter(){
       // echo "listes ajouter";


        $arr_erreur = null;

        if($this->validerFormulaire()) {


            $this->arr_erreur = $this->obj_donnees->ajouterListe(1, $_GET['couleur_id'], $_GET['nom_liste']);

        if($this->arr_erreur[0]=="00000"){
            //echo "test11111";
            header("Location: index.php?confirmation=Modification effectuée avec succès!");
        } else{
            header("Location: index.php?confirmation=Une erreur s'est produite lors de la modification.");
        }

        }else{
            $this->arr_validations=serialize($this->arr_validations);
            header("Location: index.php?validation=".$this->arr_validations);
        }


    }

    public function modifier($id_liste, $nom_liste, $couleur_id){
        $arr_erreur = null;
        if($this->validerFormulaire()) {

        $this->arr_erreur = $this->obj_donnees->modifierListe($id_liste, $nom_liste, $couleur_id);
        //var_dump($this->arr_erreur);

        if($this->arr_erreur[0]=="00000"){
           // echo "test11111";
            header("Location: index.php?confirmation=Modification effectuée avec succès!");
        } else{
            header("Location: index.php?confirmation=Une erreur s'est produite lors de la modification.");
        }


        }else{
            $this->arr_validations=serialize($this->arr_validations);
            header("Location: index.php?validation=".$this->arr_validations);
        }

}

    public function supprimer(){
        //echo "listes supprimer";
        $arr_erreur = null;
        $this->arr_erreur = $this->obj_donnees->supprimerListe($_GET['id_liste']);

        if($this->arr_erreur[0]=="00000"){
            // echo "test11111";
            header("Location: index.php?confirmation=Modification effectuée avec succès!");
        } else{
            header("Location: index.php?confirmation=Une erreur s'est produite lors de la modification.");
        }
    }

    public function validerFormulaire():bool{
       // echo "listes validerFormulaire";
        $this->arr_validations=[];

        $this->arr_validations= Utilitaires::validerChamp('nom_liste', "#^[0-9a-zA-ZÀ-ÿ' -]+$#", $this->arr_messages, $this->arr_validations);
        $this->arr_validations= Utilitaires::validerGroupeBoutonRadio('couleur_id', '0', $this->arr_messages, $this->arr_validations, false);



        //teste si tous les champs sont valides dans le tableau de validation.

        $sousTableau = array_column($this->arr_validations, 'valide');
        //retourne 'true' si la valeur 'faux' est trouvée...
        $trouverFaux = in_array('faux', $sousTableau);
        //retourne le résultat inversé 'faux' pour invalide 'vrai' pour valide

        return !$trouverFaux;
    }

}