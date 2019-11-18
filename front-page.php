<?php get_header(); ?>

<?php $baner = get_field('baner');?>

<section id="baner">
    <div class="container">
        <h1><?php echo $baner['slodkie'];?></h1>
        <h2><?php echo $baner['cuda'];?></h2>
        <div class="wjazd">
            <section class="animation-box">
                <div class="fourth-text">Witaj na mojej stronie</div>
            </section>
        </div>
     </div>
</section>

<?php $sekcja_wypieki = get_field('sekcja_wypieki');?>

<section class="wypieki">
     <div class="container">
        <h1><?php echo $sekcja_wypieki['wypieki'];?></h1>
    </div>
</section>
            
<section class="ostatnie_realizacje">
    <div class="container">
        <?php 
        //  TORTY
            if ( have_posts() ) : while (have_posts() ) : the_post();
                the_content();
                endwhile; else: ?>
                <p>Sorry</p>
        <?php endif; ?>
    </div>
</section>

<section id="wiadomosc">
    <div class="container">
        <div class="naglowek">
            <h2>Zostaw wiadomość</h2>
            <p id="gwiazdka">*</p>
            <p>Masz pytania lub po prostu chcesz mi coś powiedzieć? <br>
            Wyślij wiadomość na interesujący Cię temat.<br>
            Odpowiem błyskawicznie!</p>
        </div >
        <div class="takie"> 
            <?php if ( is_active_sidebar( 'sidebar-default' ) ) : ?>
                <div class="obok" id="formularz"> 
                     <?php dynamic_sidebar( 'sidebar-default'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

 <?php get_footer(); ?>