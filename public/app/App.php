<?php
declare(strict_types=1);

//Définition de l'espace de nom.
namespace app;

//Chargement des classes nécessaires à l'application.
//Modèle de données
require_once('ModeleTOFU.php');

//Vues
require_once('ConnexionBD.php');
require_once('Accueil.php');
require_once('Listes.php');
require_once('Items.php');
//Utilitaires
require_once('Utilitaires.php');

//Utilisation de la classe PDO de php
use \PDO;

class App
{
    //Propriété référence à l'instance de PDO de PHP.
    private $obj_pdo= null;

    //Propriétés références des instances des objets de l'application.
    private $obj_donnees=null;

    private $obj_accueil = null;
    private $obj_listes = null;
    private $obj_items = null;

    /**
     * Constructeur de la classe (application)
     */
    public function __construct()
    {
    }

    /**
     * Fonction de démarrage de l'application.
     * Configure l'environnement, le modèle de données.
     * et mets en place toutes les instances nécessaires au bon
     * fonctionnement de l'application.
     * Affiche une première page (Accueil).
     */
    public function demarrer():void
    {
        //configuration de l'environnement
        $this->configurerEnvironnement();
        $this->getPDO();

        $this->obj_donnees=new ModeleTOFU($this->obj_pdo);
        //var_dump($this->obj_pdo);
        $this->obj_accueil=new Accueil($this->obj_donnees);
        $this->obj_listes=new Listes($this->obj_donnees);
        $this->obj_items=new Items($this->obj_donnees);
        $this->routerLaRequete();
    }

    /**
     * Fonction de configuration de l'environnement.
     * Défini les paramètres d'affichage des erreurs, et
     * le fuseau horaire du serveur.
     */
    private function configurerEnvironnement():void
    {
        if($this->getServeur() === 'serveur-local'){
            error_reporting(E_ALL | E_STRICT);
        }else{
            //Temporaire pour développement
            error_reporting(E_ALL);
            //Empêche tout rapport d’erreurs
            //error_reporting(0);
        }
        date_default_timezone_set('America/Montreal');
    }

    /**
     * Fonction de détection de la localisation du serveur.
     * Retourne si le server est local, ou distant.
     * @return string
     */
    private function getServeur():string
    {
        // Vérifier la nature du serveur (local VS production)

        //var_dump($_SERVER);
        $env = 'null';
        if ((substr($_SERVER['HTTP_HOST'], 0, 9) == 'localhost'))
        {
            $env = 'serveur-local';
        } else {
            $env = 'serveur-production';
        }
        return $env;
    }
    /**
     * Fonction de configuration de la connexion vers la base de données. (local vs distant)
     * Retourne l'objet de la connexion.
     * @return PDO
     */
    
    private function getPDO():void
    {
        // C'est plus performant en ram de récupérer toujours
        // la même connexion PDO dans toute l'application.
        if($this->obj_pdo === null)
        {
            if($this->getServeur() === 'serveur-local')
            {
                $maConnexionBD = new ConnexionBD('localhost','root','root','tofu_rpni1_2021');
            }else{
                //echo "Erreur: Vous devez configurer la connexion du serveur de production (timunix2).";
                $maConnexionBD = new ConnexionBD('localhost','21_insertteam','carotte_cyan','21_rpni1_insertteamnamehere');
            }
            $this->obj_pdo = $maConnexionBD->getNouvelleConnexionPDO();
        }
    }

    /**
     * Fonction d'aiguillage de l'application.
     * Effectue la lecture de la querystring, détermine la page à afficher
     * et l'action à effectuer dans la page.
     */
    public function routerLaRequete():void
    {
        $page = null;
        $action = null;

     
            // Déterminer la page où traiter la requête
            if (isset($_GET['page'])){
                $page = $_GET['page'];
                $action = $_GET['action'];
            }else{
                $page = 'site';
                $action = 'afficher';
            }
     

        //Selon la page demandée
        switch ($page){
            //Page Accueil
            case $page === 'site':
                //effectuer l'action de la page
                switch ($action) {
                    case 'afficher':
                        $this->obj_accueil->afficher();
                        break;
                    default:
                        //Si l'action est indéfinie, afficher une erreur
                        echo 'Action indéterminé pour la page Accueil!';
                }
            break;
            //Listes
            case $page === 'listes':
                //effectuer l'action de la page
                switch ($action) {
                    case 'afficher':
                        $this->obj_listes->afficher();
                        break;
                    case 'afficherAjouter':
                        $this->obj_listes->afficherAjouter();
                        break;
                    case 'afficherModifier':
                        $this->obj_listes->afficherModifier($_GET['id_liste']);
                        break;
//                    case 'trouverNombreItems':
//                        $this->obj_listes->trouverNombreItems();
//                        break;
                    case 'ajouter':
                        $this->obj_listes->ajouter();
                        break;
                    case 'modifier':
                        $this->obj_listes->modifier($_GET['id_liste'], $_GET['nom_liste'], $_GET['couleur_id']);
                        break;
                    case 'supprimer':
                        $this->obj_listes->supprimer();
                        break;
                    default:
                        //Si l'action est indéfinie, afficher une erreur
                        echo 'Action indéterminé pour la page listes!';
                }
                break;
            //Items
            case $page === 'items':
                //effectuer l'action de la page
                switch ($action) {
                    case 'afficher':
                        $this->obj_items->afficher($_GET['id_liste']);
                        break;
                    case 'afficherAjouter':
                        $this->obj_items->afficherAjouter();
                        break;
                    case 'afficherModifier':
                        $this->obj_items->afficherModifier($_GET['id_item']);
                        break;
                    case 'ajouter':
                        $this->obj_items->ajouter();
                        break;
                    case 'modifier':
                        $this->obj_items->modifier();
//                        $_GET['id_item'], $_GET['id_liste'], $_GET['nom_item']
//                        $_GET['id_item'], $_GET['id_liste'], $_GET['nom_item'], $this->item_echeace=($_GET['jour'].$_GET['mois'].$_GET['annee']))
                        break;
                    case 'supprimer':
                        $this->obj_items->supprimer();
                        break;
                    case 'changerEtatCompleter':
                        $this->obj_items->changerEtatCompleter();
                        break;
                    default:
                        //Si l'action est indéfinie, afficher une erreur
                        echo 'Action indéterminé pour la page items!';
                }
                break;


            
			
			//*******************************
            /*case $page === 'unePage':
                //effectuer l'action de la page
                switch ($action) {
					//un cas
                    case 'uneAction':
                        $this->unObjet->uneAction();
                        break;
            
					//option par defaut
                    default:
                        //Si l'action est indéfinie, afficher une erreur
                        echo 'Action indéterminé pour la page unPage!';
                }
                break;*/
			//*******************************
            

            default:
                echo "Erreur 404. Page indéfinie!";
        }
    }
}