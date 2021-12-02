<?php
declare(strict_types=1);

namespace app;
use DateTime;

class Items
{

    private $str_titrePage = " ";
    private $str_nomListe = " ";
    private $obj_donnees = null;
    private $arr_listes = null;
    private $arr_items = null;
    private $arr_liste = null;
    private $arr_item = null;
    private $arr_messages = null;
    private $arr_validations = null;
    private $str_hexa = " ";

    public function __construct($obj_mod)
    {
        $this->obj_donnees=$obj_mod;
        $this->arr_messages=Utilitaires::chargerFichierJSON("liaisons/js/objJSONMessages.json", true);

    }

	public function afficher($id_liste)
    {
		//echo "afficher items";

        $this->arr_listes = $this->obj_donnees->trouverListes();

		$this->arr_items = $this->obj_donnees->trouverItems($id_liste);
        $this->arr_liste = $this->obj_donnees->trouverUneListe($id_liste);

        $this->str_titrePage= $this->arr_liste["nom"];
        $this->str_hexa = " #" . $this->arr_liste["hexadecimal"];
        $this->str_nomListe = "Items";


        //var_dump($this->arr_liste);

        include_once("liaisons/fragments/header.inc.php");
        include_once ("liaisons/fragments/contenuhaut.inc.php");

        include_once ("liaisons/fragments/items.inc.php");

        include_once ("liaisons/fragments/contenubas.inc.php");
        include_once("liaisons/fragments/footer.inc.php");
    }

    public function afficherEcheance(){
        echo "items afficherEcheance";
    }

    public function afficherAjouter(){

        if(isset($_GET['validation'])){
            $this->arr_validations=unserialize($_GET['validation']);
        }
        $this->arr_listes = $this->obj_donnees->trouverListes();

        // echo "items afficherAjouter";
        $this->str_titrePage="Ajouter un item";

        include_once("liaisons/fragments/header.inc.php");
        include_once ("liaisons/fragments/contenuhaut.inc.php");

        include_once ("liaisons/fragments/afficherModifierItem.inc.php");

        include_once ("liaisons/fragments/contenubas.inc.php");
        include_once("liaisons/fragments/footer.inc.php");
    }

    public function afficherModifier($id_item){
        //echo "items afficherModifier";
        if(isset($_GET['validation'])){
            $this->arr_validations=unserialize($_GET['validation']);
        }
        $this->arr_listes = $this->obj_donnees->trouverListes();
        $this->arr_item = $this->obj_donnees->trouverUnItem($id_item);

        $this->str_titrePage="Modifier un item";

        //var_dump($this->arr_item);
        //var_dump($this->arr_listes);

        include_once("liaisons/fragments/header.inc.php");
        include_once ("liaisons/fragments/contenuhaut.inc.php");

        include_once ("liaisons/fragments/afficherModifierItem.inc.php");

        include_once ("liaisons/fragments/contenubas.inc.php");
        include_once("liaisons/fragments/footer.inc.php");
    }

    public function ajouter(){
        //echo "items ajouter";
        $arr_erreur = null;

        if($this->validerFormulaire()) {


            if(checkdate(intval($_GET['mois']),intval($_GET['jour']),intval($_GET['annee']))){
                    $item_echeance=$_GET['annee']."-".$_GET['mois']."-".$_GET['jour']." "."00:00:00";
                }else{
                    $item_echeance = null;
                }

            $this->arr_erreur = $this->obj_donnees->ajouterItem($_GET['id_liste'], $_GET['nom_item'], $item_echeance);
        //var_dump($this->arr_erreur);
            if($this->arr_erreur[0]=="00000"){
                echo "test11111";
                header("Location: index.php?confirmation=Modification effectuée avec succès!");
            } else{
                header("Location: index.php?confirmation=Une erreur s'est produite lors de la modification.");
            }


        }else{
            $this->arr_validations=serialize($this->arr_validations);
            header("Location: index.php?page=items&action=afficherModifier&id_item=".$_GET['id_item']."&validation=".$this->arr_validations);
        }

    }

    public function modifier(){
        $arr_erreur = null;

        if($this->validerFormulaire()) {
            if(checkdate(intval($_GET['mois']),intval($_GET['jour']),intval($_GET['annee']))){
                $item_echeance=$_GET['annee']."-".$_GET['mois']."-".$_GET['jour']." "."00:00:00";
            }else{
                $item_echeance = null;
            }

            $this->arr_erreur = $this->obj_donnees->modifierItem($_GET['id_item'], $_GET['id_liste'], $_GET['nom_item'], $item_echeance);

//        echo $_GET['id_liste'] . " " . $_GET['nom_item'];
//
//        var_dump($this->arr_erreur);
            if($this->arr_erreur[0]=="00000"){
                echo "test11111";
                header("Location: index.php?confirmation=Modification effectuée avec succès!");
            } else{
                header("Location: index.php?confirmation=Une erreur s'est produite lors de la modification.");
            }
        }else{
            $this->arr_validations=serialize($this->arr_validations);
            header("Location: index.php?page=items&action=afficherModifier&id_item=".$_GET['id_item']."&validation=".$this->arr_validations);
        }




    }

    public function supprimer(){
        //echo "items supprimer";
        $arr_erreur = null;
        $this->arr_erreur = $this->obj_donnees->supprimerItem($_GET['id_item']);

        if($this->arr_erreur[0]=="00000"){
            // echo "test11111";
            header("Location: index.php?confirmation=Modification effectuée avec succès!");
        } else{
            header("Location: index.php?confirmation=Une erreur s'est produite lors de la modification.");
        }
    }

    public function changerEtatCompleter(){
        //echo "items changerEtatCompleter";
        $arr_erreur = null;

        $this->arr_erreur = $this->obj_donnees->changerEtatCompleter($_GET['id_item'], $_GET['est_complete'], $_GET['id_liste']);


        if($this->arr_erreur[0]=="00000"){
             echo "OUI";
            header("Location: index.php?page=items&action=afficher&id_liste=" . $_GET['id_liste'] . "&confirmation=Modification effectuée avec succès!");
        } else{
            echo "NON";
            header("Location: index.php?confirmation=Une erreur s'est produite lors de la modification.");
        }
    }

    private function validerFormulaire():bool{
        //echo "items validerFormulaire";
        $this->arr_validations=[];

        $this->arr_validations= Utilitaires::validerChamp('nom_item', "#^[a-zA-ZÀ-ÿ' -]+$#", $this->arr_messages, $this->arr_validations);

        $this->arr_validations= Utilitaires::validerSelecteur('id_liste', '0', $this->arr_messages, $this->arr_validations);

        $this->arr_validations= Utilitaires::validerDateEcheance('annee', 'mois', 'jour', $this->arr_messages, $this->arr_validations);

        //teste si tous les champs sont valides dans le tableau de validation.

        $sousTableau = array_column($this->arr_validations, 'valide');
        //retourne 'true' si la valeur 'faux' est trouvée...
        $trouverFaux = in_array('faux', $sousTableau);
        //retourne le résultat inversé 'faux' pour invalide 'vrai' pour valide

        return !$trouverFaux;
    }

}