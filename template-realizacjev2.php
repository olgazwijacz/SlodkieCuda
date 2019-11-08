<?php 
/* Template Name: Realizacjev2 */
get_header(); ?>

    <div class="tlo">
    <!--Galeria 1-->
    <?php $realizacje = get_field('torty');?>
    <section class="naglowek_torty">
        <div class="container">
                <h1><?php echo $realizacje['tytul_sekcji_i'];?></h1>
                <p id="gwiazda_realizacje">* * *</p>
                <p id="opis_realizacje"><?php echo $realizacje['opis_sekcji_i'];?></p>
        </div>
    </section>
    <section class="galeria_tortow">
        <div class="container">
            
        <?php if ( have_posts() ) : while (have_posts() ) : the_post();
                        the_content();
                        endwhile; else: ?>
                        <p>Sorry</p>
                        <?php endif; ?>  

    </div>
</section>
</div>
    <!--Jak to działa-->
    <?php $realizacje = get_field('jak_to_dziala');?>
    <section class="how">
        <div class="container">
        <h2><?php echo $realizacje['tytul_sekcji_iii'];?></h2>
        <h3>*</h3>
        <p><?php echo $realizacje['opis_sekcji_iii'];?>
        </p>
        <div class="center">
        <button type="button" class="button" onclick="window.location.href='/cennik-i-zamowienia'">Zamówienia</button>
    </div>
    </div>
</section>

<?php get_footer(); ?>