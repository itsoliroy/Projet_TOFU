
<section>
    <div class="etiquette">
        <h2> <?php echo $this->str_nomListe; ?> </h2>
        <a href="index.php?page=items&action=afficherAjouter&id_liste=<?php echo $_GET['id_liste']; ?>"><i class="far fa-plus-square titreNiveau1"></i></a>
    </div>

    <ul class="liste">

        <?php foreach ($this->arr_items as $item){ ?>

            <li>
                <div class="liste--bulle">
                    <div class="liste--bulle--content-top">
                        <h3><?php echo $item['nom']; ?></h3>

                        <p><?php echo $item['echeance']; ?></p>

                        <!--        <p>--><?php //echo $this->obj_donnees->trouverNombreItems($liste['id']); ?><!-- Items</p>-->

                    </div>
                    <div class="liste--bulle--content-bottom">
                        <div>
                            <a href="index.php?page=items&action=afficherModifier&id_item=<?php echo $item['id']; ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#modale_item<?php echo $item['id']; ?>">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                        <?php
                        if($item['est_complete']=='1'){?>
                            <a href="index.php?page=items&action=changerEtatCompleter&id_item=<?php echo $item['id']; ?>&est_complete=0&id_liste=<?php echo $item['liste_id']; ?>">
                                <i class="far fa-check-square titreNiveau1"></i>                            </a>
                        <?php } else {?>
                            <a href="index.php?page=items&action=changerEtatCompleter&id_item=<?php echo $item['id']; ?>&est_complete=1&id_liste=<?php echo $item['liste_id']; ?>">
                                <i class="far fa-square titreNiveau1"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div id="modale_item<?php echo $item['id']; ?>" class="boiteModale">
                    <div class="boiteModale__dialogue">
                        <div class="boiteModale__fenetre">
                            <header class="boiteModale__entete">
                                <a href="#" class="titreNiveau1"><i class="fas fa-times"></i></a>
                            </header>
                            <div class="boiteModale__contenu">
                                <p><strong>Voulez-vous vraiment supprimer l'item' "<?php echo $item['nom']; ?>"?</strong></p>

                            </div>
                            <footer class="boiteModale__actions">
                                <a href="#" class="btn btn--inverse">Annuler</a>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn--danger" href="index.php?page=items&action=supprimer&id_item=<?php echo $item['id']; ?>" >Supprimer</a>
                            </footer>
                        </div>
                    </div>
                </div>

            </li>






        <?php } ?>
    </ul>
</section>
