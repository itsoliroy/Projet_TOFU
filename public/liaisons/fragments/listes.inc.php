
<section>
    <div class="etiquette">
    <h2>Listes</h2>

    <a href="index.php?page=listes&action=afficherAjouter"><i class="far fa-plus-square titreNiveau1"></i></a>
    </div>
<ul class="liste galerie">

    <?php foreach ($this->arr_listes as $liste){ ?>

    <li class="galerie__item">
        <div class="liste--bulle">
            <div class="liste--bulle--content-top">
        <a href="index.php?page=items&action=afficher&id_liste=<?php echo $liste['id']; ?>">
        <h3><?php echo $liste['nom']; ?></h3>
        </a>

<!--        <p>--><?php //echo $this->obj_donnees->trouverNombreItems($liste['id']); ?><!-- Items</p>-->

        <p><?php $t = $this->obj_donnees->trouverNombreItems($liste['id']); if ($t > 1) { echo $t . " Items"; } else { echo $t . " Item"; } ?></p>
            </div>
            <div class="liste--bulle--content-bottom">

            <div>
                 <a href="index.php?page=listes&action=afficherModifier&id_liste=<?php echo $liste['id']; ?>">
                     <i class="fas fa-edit"></i>
                 </a>
                 <a href="index.php#modale<?php echo $liste['id']; ?>">
                     <i class="far fa-trash-alt"></i>
                 </a>
            </div>
            <div class="couleur" style="background-color: <?php echo "#" . $liste['hexadecimal']; ?>;"></div>
            </div>

        </div>


        <div id="modale<?php echo $liste['id']; ?>" class="boiteModale">
            <div class="boiteModale__dialogue">
                <div class="boiteModale__fenetre">
                    <header class="boiteModale__entete">
                        <a href="#" class="titreNiveau1"><i class="fas fa-times"></i></a>
                    </header>
                    <div class="boiteModale__contenu">
                        <p><strong>Voulez-vous vraiment supprimer la liste "<?php echo $liste['nom']; ?>" et tout ce qu'elle contient?</strong></p>

                    </div>
                    <footer class="boiteModale__actions">
                        <a href="#" class="btn btn--inverse">Annuler</a>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn--danger" href="index.php?page=listes&action=supprimer&id_liste=<?php echo $liste['id']; ?>" >Supprimer</a>
                    </footer>
                </div>
            </div>
        </div>
    </li>






<?php } ?>
</ul>
</section>
