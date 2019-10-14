<?php 
/* Template Name: Cennik */
get_header(); ?>
<!--Treść-->
<div class="biale_tlo_zam">
<section id="baner_zamowienia">
    <img class="kwiatek" src="<?php bloginfo('template_directory');?>/images/kwiatek.png">
</section>
<?php $cennik_i_zamówienia = get_field('zamowienia');?>
<section class="site_title"> 
    <div class="container">
        <h1><?php echo $cennik_i_zamówienia['tytul_glowny'];?></h1>
        <p>* * *</p>
    </div>
 </section>
 <div class="flex_zam_container">
 <section class="lewo_zamowienia">
        <div class="opis_zamowienia">
            <h2 id="zamow"><?php echo $cennik_i_zamówienia['tytul_sekcji_i'];?><h2>
            <p id="koment"><?php echo $cennik_i_zamówienia['opis_sekcji_i'];?></p>
            <p id="dane"><?php echo $cennik_i_zamówienia['telefon'];?><span id="wyjscie"><?php echo $cennik_i_zamówienia['nr_telefonu'];?></span></p>
            <p id="dane"><?php echo $cennik_i_zamówienia['email'];?><span id="wyjscie"><?php echo $cennik_i_zamówienia['adres_email'];?></span></p>
            <h3 id="lub"><?php echo $cennik_i_zamówienia['opis_kontynuacja'];?></h3>
            <h2 id="form"><?php echo $cennik_i_zamówienia['nazwa_formularza'];?></h2>
            <p id="koment2"><?php echo $cennik_i_zamówienia['opis_formularz'];?><span id="kursywa"><?php echo $cennik_i_zamówienia['opis_formularz_ii'];?></span></p>
        </div>
        <div class="float">
        <div class="formularz_zamowienia">
            <h2>Twoje zamówienie</h2>
            <div class="poziomI_zam">
            <?php if ( have_posts() ) : while (have_posts() ) : the_post();
            the_content();
            endwhile; else: ?>
            <p>Sorry</p>
        <?php endif; ?>
        </div>
                
      
        
    </div>
    <img class="kwiatuszek" src="<?php bloginfo('template_directory');?>/images/kwiatform.png">
 </section>
<section class="prawo_zamowienia"> 
    <div class="prawo_zamowienia_transparent">
        <div class="cennik">
        <?php $cennik_i_zamowienia = get_field('cennik');?>
            <h2><?php echo $cennik_i_zamowienia['tytul_sekcji'];?></h2>
            <p id="gwiazda_zam">* * *</p>
          <p class="opis_cennik_zam"><?php echo $cennik_i_zamowienia['opis_sekcji'];?></p>
        </div>
        <div>
        <table class="tresc_cennik"> 
  <thead class="opis_tabela_zam">
  <?php $naglowki_tabeli = get_field('naglowki_tabeli');?>
    <tr>
      <th scope="col"><?php echo $naglowki_tabeli['parametr_i'];?></th>
      <th scope="col"><?php echo $naglowki_tabeli['parametr_ii'];?></th>
      <th scope="col"><?php echo $naglowki_tabeli['parametr_iii'];?></th>
      <th scope="col"><?php echo $naglowki_tabeli['parametr_iv'];?></th>
    </tr>
  </thead>
  <tbody class="cennik_zam">
  <?php

     //  TORTY 
     $entries = get_post_meta( get_the_ID(), 'tabela', true );

     foreach ( (array) $entries as $key => $entry ) {
     
         $titleone = $titletwo = $titletthree = $titlefour = '';
     
         if ( isset( $entry['a'] ) ) {
          $titleone = esc_html( $entry['a'] );
         }
     
         if ( isset( $entry['b'] ) ) {
          $titletwo = esc_html( $entry['b'] );
         }
     
         if ( isset( $entry['c'] ) ) {
          $titletthree = esc_html( $entry['c'] );
         }
         if ( isset( $entry['d'] ) ) {
          $titlefour = esc_html( $entry['d'] );
         }
      
        // Do something with the data
        ?>
    <tr>
      <td><?php echo $titleone;?></td>
      <td><?php echo $titletwo;?></td>
      <td><?php echo $titletthree;?></td>
      <td><?php echo  $titlefour;?></td>
    </tr>
        <?php
    }
    ?>
      </tfoot>
</table>

        <p id="gwiazda2_zam">*</p>
        </div>
    </div>
</section>
</div>
</div>
<?php get_footer(); ?>