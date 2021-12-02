<?php
use app\Utilitaires;
//À utiliser avec le sélecteur des mois
//$mois=array('janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
?>

<section>
    <form action="index.php" method="get">

        <input type="hidden" name="page" value="items">

        <?php if(isset($this->arr_item)){ ?>
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id_item" value="<?php echo $this->arr_item['id']; ?>">
        <?php }else{ ?>
            <input type="hidden" name="action" value="ajouter">
        <?php } ?>

        <?php if(isset($this->arr_item)){ ?>

        <?php }else{ ?>

        <?php } ?>



            <label for="nom_item" class="titreNiveau2">Item: </label>
            <input type="text"
                   name="nom_item"
                   id="nom_item"
                   value="<?php if(isset($this->arr_item)){ echo $this->arr_item['nom'];
         }  ?>"
                   class="input_text" required>

        <label for="id_liste" class="titreNiveau2">Dans la liste: </label>
        <select name="id_liste" id="id_liste" class="select" required>
            <option value="">Choisissez une liste</option>
            <?php foreach ($this->arr_listes as $arr_liste){ ?>
                <option value=<?php echo $arr_liste['id']; ?>
                    <?php

                if(isset($this->arr_item)) {
                    if ($arr_liste['id'] == $this->arr_item['liste_id']) {
                        echo 'selected';
                    }

                } else{
                    if ($arr_liste['id'] == $_GET['id_liste']) {
                        echo 'selected';
                    }
                }

                ?>>
                    <?php echo $arr_liste['nom']; ?>
                </option>
            <?php } ?>
        </select>
<div class="optionEcheance">
        <fieldset class="optionEcheance__bloc">
            <legend class="">




 <!--TODO -- CODE PROBABLEMENT PAS BON (CI-DESSOUS)-->
                <?php
                if(isset($this->arr_item)){
                if ($this->arr_item['mois']!= null){
                    echo "Modifier l'échéance";
                }else{
                    echo "Ajouter une échéance";
                }}else{
                    echo "Ajouter une échéance";
                }?> : </legend>
            <p>
                <label for="jour" class="visuallyhidden">Jour</label>
                <select name="jour" id="jour" class="select">
                    <option value="0">Jour</option>
                    <?php for($cpt = 1;$cpt <= 31;$cpt++){ ?>
                        <option value=<?php echo $cpt?>
                            <?php if(isset($this->arr_item)){
                                if ($this->arr_item['jour']==$cpt){
                                    echo 'selected';
                                }
                            } ?>>

                            <?php echo $cpt;?>

                        </option>
                    <?php } ?>
                </select>
                <label for="mois" class="visuallyhidden">Mois</label>
                <select id="mois" name="mois" class="select">
                    <option value="0">Mois</option>

                    <?php for($cpt = 1;$cpt < 13;$cpt++){ ?>
                        <option value="<?php echo $cpt?>"
                            <?php if(isset($this->arr_item)){
                            if ($this->arr_item['mois']==$cpt){
                                echo 'selected';
                            }
                        } ?>>
                            <?php echo Utilitaires::convertirMois($cpt);?>

                        </option>
                    <?php } ?>
                </select>

                <label for="annee" class="visuallyhidden">Année</label>
                <select id="annee" name="annee" class="select">
                    <option value="0">Année</option>
                    <?php
                    $aujourdhui=new DateTime();
                    for($cpt = intval($aujourdhui->format('Y'));$cpt < intval($aujourdhui->format('Y'))+20;$cpt++){ ?>
                        <option value=<?php echo $cpt?>
                            <?php if(isset($this->arr_item)){
                                if ($this->arr_item['annee']==$cpt){
                                    echo 'selected';
                                }
                            } ?>>
                            <?php echo $cpt;?>

                        </option>
                    <?php } ?>
                </select>
            </p>
        </fieldset>
</div>
        <div class="etiquette-bottom">
            <?php if(isset($this->arr_item)){ ?>
                <button type="submit" class="btn">Enregistrer l'item</button>
            <?php }else{ ?>
                <button type="submit" class="btn">Ajouter l'item</button>
            <?php } ?>
            <a href="index.php" class="btn btn--inverse">Annuler</a>
        </div>
    </form>

</section>
