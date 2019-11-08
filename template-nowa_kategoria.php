

<?php 
/* Template Name: Nowa_kategoria */
get_header(); ?>
 <section id="baner_opisowej">
    <div class="container">
        <h1>Słodkie</h1>
         <h2>Cuda</h2>  
    </div>
</section>
<div class="tlo">
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