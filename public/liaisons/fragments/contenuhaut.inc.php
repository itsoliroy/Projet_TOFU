<noscript>
    <p>Le JavaScript n'est pas activé dans votre navigateur. Nous vous recommandons de l'activer afin d'améliorer votre expérience utilisateur.</p>
</noscript>


<main class="container">
    <?php //Bel endroit pour mettre un fil d'Arianne?>



    <?php if(isset($_GET['page'])){ ?>
        <aside class="conteneur_gauche">

            <nav class="menu menu--bureau">
                <ul>
                <li class="" id="btn-nav">
                    <a href="index.php">
                        <div class="etiquette">
                            <h2>Tableau de bord</h2>
                            <i class="fas fa-home titreNiveau1"></i>
                        </div>
                    </a>
                </li>
                    <?php if($_GET['page'] != "listes") { ?>
                <li class="" id="btn-nav">

                    <a href="index.php?page=listes&action=afficherAjouter">
                        <div class="etiquette">
                            <h2>Nouvelle liste</h2>

                            <i class="far fa-plus-square titreNiveau1"></i></div>
                    </a>

                </li>
                    <?php } ?>
                </ul>
                <h2>Mes Listes :</h2>
                <ul class="">

<!--                    <li class=""><a href="index.php?page=listes&action=afficherAjouter">Ajouter une liste</a></li>-->


                    <?php foreach ($this->arr_listes as $arr_liste){ ?>
                        <li class="">
                            <a href="index.php?page=items&action=afficher&id_liste=<?php echo $arr_liste['id'];?>"><?php echo  $arr_liste['nom'];?></a><div class="couleur" style="background-color: #<?php echo $arr_liste['hexadecimal']; ?>"></div>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </aside>
    <?php  }else { ?>

    <?php } ?>
    <div class="conteneur_droit">
        <div class="titre">
        <div class="etiquette">

                <h1><?php echo $this->str_titrePage; ?></h1>
            <?php if(isset($_GET['page'])  ==  "items"){ ?>
            <div class="couleur" style="background-color: <?php echo $this->str_hexa; ?>"></div><?php } ?>
        </div>

            <?php
            if(isset($_GET["confirmation"])){?>
                <p class="m-l"><?php echo $_GET["confirmation"]?></p>
            <?php }?>
        </div>

