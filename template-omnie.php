<?php 
/* Template Name: O mnie */
get_header(); ?>
 <!--TRESC-->
 <?php $lewo = get_field('lewo');?>
 <?php $prawo = get_field('prawo');?>
 <div class="biale_tlo_omnie">
    <section id="baner_omnie"></section>
    <section class="flex_omnie_container"> 
            <div class="prawo_omnie"> 
                <div class="opis_ogolny2">
                <h2><?php echo $prawo['tytul'];?></h2>
                <p id="gwiazda3_omnie">* * *</p>
                <p class="cytat"><?php echo $prawo['cytat'];?></p>
                <p class="autor"><?php echo $prawo['autor'];?></p>
                <p id="gwiazda4_omnie">*</p>
                <p class="opis_omnie"><?php echo $prawo['o_mnie'];?></p>
                <p id="gwiazda5_omnie">*</p>
                </div>
                <div class="foto2_omnie">
                <img src="<?php
                $image =  $prawo['zdjecie_iii'];
                echo $image['url'];?>">
                <img src="<?php
                $image =  $prawo['zdjecie_iv'];
                echo $image['url'];?>">
                </div>
            </div>

            <div class="lewo_omnie">
                <div class="foto_omnie">
                <img src="<?php
                $image =  $lewo['zdjecie_i'];
                echo $image['url'];?>">
                <img src="<?php
                $image =  $lewo['zdjecie_ii'];
                echo $image['url'];?>">
                </div>
                <div class="opis_ogolny">
                    <p id="gwiazda_omnie">*</p>
                    <p class="slowa_omnie"><?php echo $lewo['opis_i'];?></p>
                    <p id="gwiazda2_omnie">*</p>
                </div>
            </div>
        </section>
        </div>
    </section>
    </div>



                
            
<?php get_footer(); ?>