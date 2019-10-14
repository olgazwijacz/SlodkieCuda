
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Słodkie cuda">
    <meta name="keywords" content="Słodkie cuda, torty na zamówienie, wypieki">
	<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}
?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body>
	<header class="page-header ">
            <nav class="container">
                <?php 
                  wp_nav_menu(
                    array(
                      'theme_location' => 'top-menu',
                      'container' => 'ul',
                      'menu_class' => 'navigation-menu',

                    )
                  )
                ?>
                <button type="button" title="Open menu" class="hamburger">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="37" height="37" viewBox="0 0 154 154" class="open">
                        <image id="Warstwa_1" data-name="Warstwa 1" x="4" y="27" width="146" height="183" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJIAAAC3BAMAAAALNBo4AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAHlBMVEXyzr4AAABNXY9NXY9NXY9NXY9NXY/yzr5NXY8AAABT8apLAAAAB3RSTlMAAEAgXZvY03yp+wAAAAFiS0dEAf8CLd4AAAAJcEhZcwAALiMAAC4jAXilP3YAAAAHdElNRQfjBQQVCRdTeoS+AAAAcklEQVRo3u3WQQ2AUBBDwbWABSxgAQtYwAIWkM1hFZD0sPmZJ2COTetJVSQSiUQipSVJWr+J60sikUgkUkuSNLWJm0kikUgkUkuSJOlPbyoSiUQKS3uq2lKRSMtLR6o6U9WVqu5UIzeTRCKRSKSWYi/6AzIkrr5eojkoAAAAAElFTkSuQmCC"/>
                      </svg>
                      
                      
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="39" height="34" viewBox="0 0 39 34" class="close">
                        <image id="Kształt_1" data-name="Kształt 1" x="7" y="6" width="25" height="23" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAXCAMAAADJPRQhAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAWlBMVEXyzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr4AAADZFRjTAAAAHHRSTlMAUbEGavykAwGBlpxpCvcSxu4+H9XkLB4/CaWyIMgPAwAAAAFiS0dEHesDcZEAAAAJcEhZcwAALiMAAC4jAXilP3YAAAAHdElNRQfjBBQWMw59hzJxAAAAcUlEQVQoz7XPOQKAIAxE0QAiKgi4b9z/nBItEwsKp5xXfQBuQir2h0qn2jB/06a8joKxCNoR6CWCFwRCRBhGAtOMsKwE1gVh3gjsA0IMtM8jyIPry7Mk8e1L7Z99W3HfWNznPvoAOr4PE0+u75m6BPvfwqkM0FbdNqkAAAAASUVORK5CYII="/>
                        <image id="Kształt_1_kopia" data-name="Kształt 1 kopia" x="7" y="6" width="25" height="23" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAXCAMAAADJPRQhAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAWlBMVEXyzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr7yzr4AAADZFRjTAAAAHHRSTlMABrJRA6X8aZaBnPexCT7uxhIs5NUeCgFqPx+kaAhT5QAAAAFiS0dEHesDcZEAAAAJcEhZcwAALiMAAC4jAXilP3YAAAAHdElNRQfjBBQWMw59hzJxAAAAaElEQVQoz73PNwKAIBQE0Y9gBCWZ5f7n1O3XxsJpXzUiqtJCM3VpWipdeeqZtA1oMIS0BbmR0ORBIRJKGTQvhJYZlBOhGEB+IrQ6kGXPZgDR560vr8/7p+fj0/P5+3PHlvF8GSqinZIbr+YM2ynME58AAAAASUVORK5CYII="/>
                      </svg>
                      
            
                </button>
            </nav>
    </header>