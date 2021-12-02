<?php

use app\Utilitaires;
?>
<section>
    <div class="etiquette">
    <h2>Échéances</h2>
    </div>
<ul class="liste">

    <?php foreach ($this->arr_items as $item){ ?>

    <li>
        <div class="liste--bulle">
            <div class="liste--bulle--content-top">
            <h3><?php echo $item['nom']; ?></h3>
<!--            <p>--><?php //echo $item['nomListe']; ?><!--</p>-->

            <p><?php echo $item['jour'] ." ". Utilitaires::convertirMois($item['mois'])." ".$item['annee']; ?></p>
            </div>
            <div class="liste--bulle--content-bottom echeance-couleur">

            <!--        <p>--><?php //echo "TEST"; ?><!--</p>-->
            <div class="couleur" style="background-color: <?php echo "#" . $item['hexadecimal']; ?>;"></div>
            </div>

        </div>
    </li>






<?php } ?>
</ul>
</section>
