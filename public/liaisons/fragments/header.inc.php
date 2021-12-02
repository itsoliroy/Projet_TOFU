<!doctype html>
<html lang="fr">
<head>
    <title>Proto N'oublie pas le tofu | POO</title>
    <meta charset="utf-8"   />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="liaisons/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div id="en-tete" class="header">
        <header class="container">
            <a href="index.php">
            <img src="liaisons/images/svg/logo_insert.svg" alt="Insert Team Name Here Logo" class="titreNiveau1 logo">
            </a>
<!--            <a href="index.php" class="titreNiveau1 logo" aria-valuetext="Insert Team Name Here"><i class="fas fa-i-cursor"></i>.T.N.H.</a>-->
<!--            <nav>-->
<!--                <ul>-->
<!--                    <li><a  href="#"><i class="fas fa-search titreNiveau1"></i></a></li>-->
<!--                    <li><a  href="#"><i class="far fa-user titreNiveau1"></i></a></li>-->
<!--                </ul>-->
<!--            </nav>-->
            <div class="barreOnglets barreOnglets--bureau">
                <ul class="barreOnglets__onglets">
                    <li class="barreOnglets__onglet ">
                        <div class="barreOnglets__bloc" id="compteUtilisateur">
                            <nav class="">
                                <a href="#" class="btn">Mon compte <i class="fas fa-user"></i></a>
                                <a href="#" class="btn">Déconnexion <i class="fas fa-sign-out-alt"></i></a>

                            </nav>

                        </div>
                        <a href="#compteUtilisateur" class="barreOnglets__controle">
                            <i class="far fa-user titreNiveau1"></i>
                        </a>

                    </li>
                    <li class="barreOnglets__onglet ">
                        <div class="barreOnglets__bloc" id="moteurRecherche">
                            <form>
                                <label for="search" class="titreNiveau3">Recherche :</label>
                                <input id="search" name="search" type="text" class="" placeholder="Tapez ici..."/>
                            </form>
                        </div>
                        <a href="#moteurRecherche" class="barreOnglets__controle">
                            <i class="fas fa-search titreNiveau1"></i>
                        </a>

                    </li>
                </ul>
            </div>
            <nav class="menu menu--mobile">
                <ul class="menu__sections">
                    <li class="menu__section">
                        <nav>
                          <a href="#" class="btn">Mon compte <i class="fas fa-user"></i></a>
                          <a href="#" class="btn">Déconnexion <i class="fas fa-sign-out-alt"></i></a>
                        </nav>
                    </li>
                    <li class="menu__section">
                        <form>
                            <label for="search" class="titreNiveau3">Recherche :</label>
                            <input id="search" name="search" type="text" class="" placeholder="Tapez ici..."/>
                        </form>
                    </li>
                    <li class="menu__section">
                        <ul>
                            <li id="btn-nav"><a href="index.php">Mon tableau de bord</a></li>
                            <li id="btn-nav"><a href="index.php?page=listes&action=afficherAjouter">Ajouter une liste <i class="far fa-plus-square titreNiveau1"></i></a></li>

                            <?php foreach ($this->arr_listes as $arr_liste){ ?>
                                <li>
                                    <a href="index.php?page=items&action=afficher&id_liste=<?php echo $arr_liste['id'];?>"><?php echo  $arr_liste['nom'];?></a><div class="couleur" style="background-color: #<?php echo $arr_liste['hexadecimal']; ?>"></div>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </nav>


        </header>
    </div>

    <div id="contenu">

