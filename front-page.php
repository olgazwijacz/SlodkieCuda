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
        </div>
    </section>

    

    <section class="ostatnie_realizacje">
        <div class="container">
                <div class="box">  
            <div class="imgBox1">
                <div class="tekst">
                    <h2>Ostatnie realizacje</h2>
                     <p>Zapraszam do zapoznania się z moimi realizacjami.
                        We wszystkich wypiekach znajdują się składniki
                            najwyższej jakości, co pozwala uzyskać wyjątkowy i wyrazisty smak.</p>
                <form>
                <input type="button" value="Zobacz Wszystkie" onclick="window.location.href='/realizacje'" />
                </form> 
                </div>
            </div>
            </div>
            <?php

     //  TORTY
     $plik = $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/slodkiecuda/dane.sc";
     $file = file_get_contents($plik,null,null);
     
     $split = explode("##", $file);
     $count = count($split);
     for ($i=0;$i<7;$i++){
         $dane = explode("||",$split[$i]);
         $title = str_replace("**"," ",$dane[0]);
         $desc = str_replace("**"," ",$dane[1]);
         $img = str_replace("**"," ",$dane[2]);?>
         <div class="box"> 
             <div class="imgBox">
                 <img src="<?php echo $img;?>">
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
                    <div class="obok" id="formularz"> 
                        <?php if ( have_posts() ) : while (have_posts() ) : the_post();
                        the_content();
                        endwhile; else: ?>
                        <p>Sorry</p>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
    </section>
    <?php get_footer(); ?>