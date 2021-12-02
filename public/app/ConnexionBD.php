<?php
declare(strict_types = 1);

namespace app;

use \PDO;

class ConnexionBD
{
    private $str_serveur = '';
    private $str_utilisateur = '';
    private $str_motDePasse = '';
    private $str_nomBd = '';

    public function __construct($unServeur, $unUtilisateur, $unMotDePasse, $unNomBd)
    {
        $this->str_serveur = $unServeur;
        $this->str_utilisateur = $unUtilisateur;
        $this->str_motDePasse = $unMotDePasse;
        $this->str_nomBd = $unNomBd;
    }

    public function getNouvelleConnexionPDO(): PDO
    {   //Data Source Name pour l'objet PDO
        $str_Dsn = 'mysql:dbname=' . $this->str_nomBd . ';host=' . $this->str_serveur;

        //Tentative de connexion
        $obj_pdo = new PDO($str_Dsn, $this->str_utilisateur, $this->str_motDePasse);

        // Changement d'encodage des caractères UTF-8
        $obj_pdo->exec("SET CHARACTER SET utf8");

        // Affectation des attributs de la connexion : Obtenir des rapports d'erreurs et d'exception avec errorInfo()
        //$obj_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //À remettre silenceux une fois le développement terminé
        $obj_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        return $obj_pdo;
    }
}