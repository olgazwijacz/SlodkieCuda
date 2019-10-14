<?php 
/* Template Name: Realizacje */
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
            
            
<?php

     //  TORTY 
    $entries = get_post_meta( get_the_ID(), 'torty', true );
    $rev_entries = array_reverse ($entries);

    $plik = $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/slodkiecuda/dane.sc";
    $file = file_get_contents($plik,null,null);
    $dane_do_zapisania = '';
    foreach ( (array) $rev_entries as $key => $entry ) {
    
        $img = $title = $desc = '';
    
        if ( isset( $entry['nazwa'] ) ) {
            $title = esc_html( $entry['nazwa'] );
        }
    
        if ( isset( $entry['opis'] ) ) {
            $desc = wpautop( $entry['opis'] );
        }
    
        if ( isset( $entry['image_id'] ) ) {
            $img = wp_get_attachment_image_src( $entry['image_id'], null );
        }
        $dane = $title."||".$desc."||".$img[0]."||##";
        $dane = str_replace(" ","**",$dane);
        $dane = str_replace('"',"&quot;",$dane);
        $dane = strtr(StripSlashes($dane), "", "");
        $dane = strip_tags($dane);
        $dane = trim(preg_replace('/\s+/', ' ', $dane));
        $dane_do_zapisania = $dane_do_zapisania.$dane;
        ?>
        <div class="box"> 
            <div class="imgBox">
                <img src="<?php echo $img[0];?>">
            </div>
            <div class="details">
                <div class="content">
                    <h2><?php echo $title;?></h2>
                    <?php echo $desc;?>
                </div>
            </div>
        </div>
        <?php
    }
    $plik = $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/slodkiecuda/dane.sc";
    $file = file_get_contents($plik,null,null);
    if ($file != $dane_do_zapisania) {
        file_put_contents($plik, $dane_do_zapisania, LOCK_EX);
        echo '<script type="text/javascript">location.reload(true);</script>';
    }
?>
    
    
    </div>
</section>
     <!--Galeria 2-->
     <?php $realizacje = get_field('wypieki');?>
<section id="naglowek_inne">
    <div class="container">
        <h1><?php echo $realizacje['tytul_sekcji_ii'];?></h1>
        <p id="opis_realizacje_inne"><?php echo $realizacje['opis_sekcji_ii'];?></p>
    </div>
</section>
<section class="galeria_inne">
    <div class="container">
        

    <?php

//  WYPIEKI
$entries = get_post_meta( get_the_ID(), 'inne_wypieki', true );
$rev_entries = array_reverse ($entries);
foreach ( (array) $rev_entries as $key => $entry ) {

   $img = $title = $desc = '';

   if ( isset( $entry['nazwa'] ) ) {
       $title = esc_html( $entry['nazwa'] );
   }

   if ( isset( $entry['opis'] ) ) {
       $desc = wpautop( $entry['opis'] );
   }

   if ( isset( $entry['image_id'] ) ) {
       $img = wp_get_attachment_image_src( $entry['image_id'], null );
   }

   // Do something with the data
   ?>
   <div class="box"> 
       <div class="imgBox">
           <img src="<?php echo $img[0];?>">
       </div>
       <div class="details">
           <div class="content">
               <h2><?php echo $title;?></h2>
               <?php echo $desc;?>
           </div>
       </div>
   </div>
   <?php
}
?>


    
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