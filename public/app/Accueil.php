<?php
declare(strict_types=1);

namespace app;
use DateTime;


class Accueil
{

    private $str_titrePage = "Mon tableau de bord";
    private $aujourdhui = null;
    private $obj_donnees = null;
    private $obj_listes = null;
    private $obj_items = null;
    private $arr_listes = null;
    private $arr_items = null;

    public function __construct($obj_mod)
    {
        $this->obj_donnees=$obj_mod;
    }

	public function afficher()
    {

        $this->arr_listes = $this->obj_donnees->trouverListes();
        $this->arr_items = $this->obj_donnees->trouverItemsAvecEcheance();

       // echo "afficher accueil";
        //var_dump($this->arr_items);
        include_once("liaisons/fragments/header.inc.php");
        include_once ("liaisons/fragments/contenuhaut.inc.php");

        include_once ("liaisons/fragments/echeance.inc.php");
        include_once ("liaisons/fragments/listes.inc.php");

        include_once ("liaisons/fragments/contenubas.inc.php");
        include_once("liaisons/fragments/footer.inc.php");


    }

}