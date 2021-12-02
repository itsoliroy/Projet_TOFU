
<section>
    <form action="index.php" method="get">

        <input type="hidden" name="page" value="listes">

        <?php if(isset($this->arr_liste)){ ?>
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id_liste" value="<?php echo $this->arr_liste['id']; ?>">
        <?php }else{ ?>
            <input type="hidden" name="action" value="ajouter">
        <?php } ?>

        <label for="nom_liste" class="titreNiveau2">Nom: </label>
        <?php if(isset($this->arr_liste)){ ?>
            <input type="text"
                   name="nom_liste"
                   id="nom_liste"
                   value="<?php echo $this->arr_liste['nom']; ?>"
                   class="input_text"
                   required
            >
        <?php }else{ ?>
            <input type="text"
                   name="nom_liste"
                   id="nom_liste"
                   value=""
                   class="input_text"
                   required
            >
        <?php } ?>

        <div class="etiquette">        <h3 class="titreNiveau2">Couleur:</h3>
            <span><?php  echo $this->arr_validations['nom_liste']['message']; ?></span>
        </div>
        <div class="selection_couleur">
            <ul class="couleurs selection_couleur-bulle">

                <?php foreach ($this->arr_couleurs as $couleur){ ?>
                    <li class="couleurs__item">

                        <input type="radio"
                               id="couleur_id<?php echo $couleur['id']; ?>"
                               name="couleur_id"
                               value="<?php echo $couleur['id']; ?>"
                            <?php if(isset($this->arr_liste)){
                                if($couleur["id"]==$this->arr_liste["couleur_id"])
                                {
                                    echo 'checked';
                                }
                            } ?>  >
                        <label for="couleur_id<?php echo $couleur['id']; ?>" data-couleur="<?php echo $couleur['nom_fr']; ?>" class="couleurs__pastille couleur" style="background-color: <?php echo "#" . $couleur['hexadecimal']; ?>;"></label>

                    </li>

                <?php } ?>
            </ul>

        </div>
        <div class="etiquette-bottom">
            <?php if(isset($this->arr_liste)){ ?>
                <button type="submit" class="btn">Modifier la liste</button>

            <?php }else{ ?>
                <button type="submit" class="btn">Ajouter la liste</button>

            <?php } ?>
            <a href="index.php" class="btn btn--inverse">Annuler</a>
        </div>
    </form>

</section>