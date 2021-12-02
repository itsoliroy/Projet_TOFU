<?php
declare(strict_types = 1);

namespace app;

//Utilisation de la classe PDO de php
use \PDO;

class ModeleTOFU
{
    private $obj_pdo=null;


    public function __construct($obj_connexion)
    {
        $this->obj_pdo=$obj_connexion;
    }

    public function trouverItemsAvecEcheance(): array{

        $str_sql = 'SELECT couleurs.id, couleurs.hexadecimal, items.id, items.nom, DAY(items.echeance) AS jour, MONTH(items.echeance) AS mois,YEAR(items.echeance) AS annee, listes.nom AS nomListe
                    FROM listes 
                    INNER JOIN couleurs ON listes.couleur_id = couleurs.id
                    INNER JOIN items ON  items.liste_id = listes.id
                    WHERE items.est_complete=0 
                    AND items.echeance IS NOT NULL
                    ORDER BY items.echeance ASC 
                    LIMIT 3';
        $obj_stmt = $this->obj_pdo->prepare($str_sql);
        $obj_stmt->execute();
        $arr_items = $obj_stmt->fetchAll();
        return $arr_items;

        return [];
    }

    public function trouverListes(): array{
        $str_sql = 'SELECT listes.id, listes.nom, couleurs.hexadecimal 
                    FROM listes 
                    INNER JOIN couleurs ON listes.couleur_id = couleurs.id
                    ORDER BY listes.nom ASC 
                    ';
        $obj_stmt = $this->obj_pdo->prepare($str_sql);
        $obj_stmt->execute();
        $arr_listes = $obj_stmt->fetchAll();
        return $arr_listes;
    }

    //TODO ne pas oublier de créer id_liste

    public function trouverNombreItems($id_liste): int{
        $str_sql = 'SELECT COUNT(*)
                    FROM items 
                    WHERE liste_id = '.$id_liste;

        $obj_stmt = $this->obj_pdo->prepare($str_sql);
        $obj_stmt->execute();
        $int_nbItem = $obj_stmt->fetch();
       return intVal($int_nbItem["COUNT(*)"]);

    }

    public function trouverUneListe($id_liste): array{
        $str_sql = 'SELECT listes.id, listes.nom, couleurs.hexadecimal, listes.couleur_id
                    FROM listes 
                    INNER JOIN couleurs ON listes.couleur_id = couleurs.id
                    WHERE listes.id='.$id_liste.'
                   ';
        $obj_stmt = $this->obj_pdo->prepare($str_sql);
        $obj_stmt->execute();
        $arr_liste = $obj_stmt->fetch();
        return $arr_liste;
    }



    public function trouverUnItem($id_item): array{
        $str_sql = 'SELECT id, nom, DAYOFMONTH(items.echeance) AS jour, MONTH(items.echeance) as mois, YEAR(items.echeance) AS annee, liste_id, echeance, est_complete 
                    FROM items 
                    WHERE items.id='.$id_item.'
                    ';
        $obj_stmt = $this->obj_pdo->prepare($str_sql);
        $obj_stmt->execute();
        $arr_item = $obj_stmt->fetch();
        return $arr_item;
    }

    public function trouverItems($id_liste): array{
        $str_sql = 'SELECT * 
                    FROM items 
                    WHERE liste_id='.$id_liste.'
                    ORDER BY echeance ASC 
                    ';
        $obj_stmt = $this->obj_pdo->prepare($str_sql);
        $obj_stmt->execute();
        $arr_items = $obj_stmt->fetchAll();
        return $arr_items;
    }

    public function trouverCouleurs(): array{
        $str_sql = 'SELECT * 
                    FROM couleurs';
        $obj_stmt = $this->obj_pdo->prepare($str_sql);
        $obj_stmt->execute();
        $arr_couleurs = $obj_stmt->fetchAll();
        return $arr_couleurs;
    }

    public function ajouterListe($id_utilisateur,$id_couleur,$nom_liste): array{

        $str_sql = "INSERT INTO listes (nom, couleur_id, utilisateur_id)
                    VALUES (:nom, :couleur_id, :utilisateur_id)";
        $obj_stmt = $this->obj_pdo->prepare($str_sql);

        $obj_stmt->bindValue(':nom', $nom_liste);
        $obj_stmt->bindValue(':couleur_id', $id_couleur);
        $obj_stmt->bindValue('utilisateur_id', $id_utilisateur);

        $obj_stmt->execute();


        return $obj_stmt->errorInfo();
    }

    public function modifierListe($id_liste, $nom_liste, $couleur_id): array{
        $str_sql = "UPDATE listes SET listes.couleur_id=:couleur_id, listes.nom=:str_nom_liste WHERE listes.id=:id_liste";
        $obj_stmt = $this->obj_pdo->prepare($str_sql);

        $obj_stmt->bindValue(':id_liste', $id_liste);
        $obj_stmt->bindValue(':str_nom_liste', $nom_liste);
        $obj_stmt->bindValue(':couleur_id', $couleur_id);


        $obj_stmt->execute();
        return $obj_stmt->errorInfo();
    }

    public function supprimerListe($id_liste): array{
        $str_sql = "DELETE FROM listes WHERE id=:id";

        $obj_stmt = $this->obj_pdo->prepare($str_sql);

        $obj_stmt->bindValue(':id', $id_liste);


        $obj_stmt->execute();


        return $obj_stmt->errorInfo();
    }

    public function ajouterItem($id_liste, $nom_item, $item_echeance): array{
        $est_complete = 0;
        $str_sql = "INSERT INTO items (liste_id, nom, echeance, est_complete)
                    VALUES (:id_liste, :nom_item, :item_echeance, :est_complete)";
        $obj_stmt = $this->obj_pdo->prepare($str_sql);

        $obj_stmt->bindValue(':id_liste', $id_liste);
        $obj_stmt->bindValue(':nom_item', $nom_item);
        $obj_stmt->bindValue(':item_echeance', $item_echeance);
        $obj_stmt->bindValue(':est_complete', $est_complete);

        $obj_stmt->execute();


        return $obj_stmt->errorInfo();
    }

    public function modifierItem($id_item, $id_liste, $nom_item, $item_echeance): array{
        $str_sql = "UPDATE items SET liste_id=:liste_id, nom=:nom_item, echeance=:item_echeance WHERE id=:id_item";
        $obj_stmt = $this->obj_pdo->prepare($str_sql);

        $obj_stmt->bindValue(':id_item', $id_item);
        $obj_stmt->bindValue(':liste_id', $id_liste);
        $obj_stmt->bindValue(':nom_item', $nom_item);
        $obj_stmt->bindValue(':item_echeance', $item_echeance);


        $obj_stmt->execute();
        return $obj_stmt->errorInfo();
    }

    public function supprimerItem($id_item): array{
        $str_sql = "DELETE FROM items WHERE id=:id";

        $obj_stmt = $this->obj_pdo->prepare($str_sql);

        $obj_stmt->bindValue(':id', $id_item);


        $obj_stmt->execute();


        return $obj_stmt->errorInfo();
    }

    public function changerEtatCompleter($id_item, $est_complete): array{
        $str_sql = "UPDATE items SET id=:id_item, est_complete=:est_complete WHERE id=:id_item";
        $obj_stmt = $this->obj_pdo->prepare($str_sql);

        $obj_stmt->bindValue(':id_item', $id_item);
        $obj_stmt->bindValue(':est_complete', $est_complete);


        $obj_stmt->execute();
        return $obj_stmt->errorInfo();
    }

}