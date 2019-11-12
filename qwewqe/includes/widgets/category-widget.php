<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Manages product category widget
 *
 * Here product category widget is defined.
 *
 * @version        1.4.0
 * @package		post-type-x/core/includes
 * @author        impleCode
 */
class product_cat_widget extends WP_Widget {

	function __construct() {
		if ( is_plural_form_active() ) {
			$names		 = get_catalog_names();
			$label		 = sprintf( __( '%s Categories', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
			$sublabel	 = sprintf( __( 'A list or dropdown of %s categories', 'post-type-x' ), ic_lcfirst( $names[ 'singular' ] ) );
		} else {
			$label		 = __( 'Catalog Categories', 'post-type-x' );
			$sublabel	 = __( 'A list or dropdown of catalog categories', 'post-type-x' );
		}
		$widget_ops = array( 'classname' => 'widget_product_categories widget_categories', 'description' => $sublabel );
		parent::__construct( 'product_categories', $label, $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( get_integration_type() != 'simple' ) {
			$instance[ 'title' ] = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
			$title				 = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
			$c					 = !empty( $instance[ 'count' ] ) ? '1' : '0';
			$h					 = !empty( $instance[ 'hierarchical' ] ) ? '1' : '0';
			$d					 = !empty( $instance[ 'dropdown' ] ) ? '1' : '0';
			do_action( 'ic_before_widget', 'product_cat_widget' );

			echo $args[ 'before_widget' ];
			if ( $title ) {
				echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
			}

			$cat_args = array( 'orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'al_product-cat' );
			if ( $d ) {
				if ( is_plural_form_active() ) {
					$names = get_catalog_names();
					if ( is_ic_taxonomy_page() ) {
						$label = sprintf( __( 'Show All %s', 'post-type-x' ), ic_ucfirst( $names[ 'plural' ] ) );
					} else {
						$label = sprintf( __( 'Select %s Category', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
					}
				} else {
					if ( is_ic_taxonomy_page() ) {
						$label = __( 'Show All', 'post-type-x' );
					} else {
						$label = __( 'Select Category', 'post-type-x' );
					}
				}
				$cat_args = array( 'orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'al_product-cat', 'walker' => new ic_cat_Walker_CategoryDropdown, 'show_option_none' => $label );
				wp_dropdown_categories( apply_filters( 'widget_product_categories_dropdown_args', $cat_args ) );
				?>

				<script type='text/javascript'>
				    /* <![CDATA[ */
				    var dropdown = document.getElementById( "cat" );
				    function onCatChange() {
				        if ( dropdown.options[dropdown.selectedIndex].value != '' ) {
				            location.href = "<?php echo home_url(); ?>/?al_product-cat=" + dropdown.options[dropdown.selectedIndex].value;
				        }
				    }
				    dropdown.onchange = onCatChange;
				    /* ]]> */
				</script>

				<?php
			} else {
				?>
				<ul>
					<?php
					$cat_args[ 'title_li' ]	 = '';
					$cat_args				 = apply_filters( 'widget_product_categories_args', $cat_args, $instance );
					add_filter( 'category_css_class', array( $this, 'add_category_parent_css' ), 10, 4 );

					wp_list_categories( $cat_args );

					remove_filter( 'category_css_class', array( $this, 'add_category_parent_css' ), 10, 4 );
					?>
				</ul>
				<?php
				do_action( 'after_product_category_widget', $cat_args, $instance );
			}

			echo $args[ 'after_widget' ];
			do_action( 'ic_after_widget', 'product_cat_widget' );
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance					 = $old_instance;
		$instance[ 'title' ]		 = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'count' ]		 = !empty( $new_instance[ 'count' ] ) ? 1 : 0;
		$instance[ 'hierarchical' ]	 = !empty( $new_instance[ 'hierarchical' ] ) ? 1 : 0;
		$instance[ 'dropdown' ]		 = !empty( $new_instance[ 'dropdown' ] ) ? 1 : 0;
		$instance					 = apply_filters( 'product_category_widget_save_instance', $instance, $new_instance, $old_instance );
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		if ( get_integration_type() != 'simple' ) {
			$instance		 = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title			 = esc_attr( $instance[ 'title' ] );
			$count			 = isset( $instance[ 'count' ] ) ? (bool) $instance[ 'count' ] : false;
			$hierarchical	 = isset( $instance[ 'hierarchical' ] ) ? (bool) $instance[ 'hierarchical' ] : false;
			$dropdown		 = isset( $instance[ 'dropdown' ] ) ? (bool) $instance[ 'dropdown' ] : false;
			?>
			<p><label
					for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'post-type-x' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
					   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
			</p>

			<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'dropdown' ); ?>"
					  name="<?php echo $this->get_field_name( 'dropdown' ); ?>"<?php checked( $dropdown ); ?> />
				<label
					for="<?php echo $this->get_field_id( 'dropdown' ); ?>"><?php _e( 'Display as dropdown', 'post-type-x' ); ?></label><br/>

				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>"
					   name="<?php echo $this->get_field_name( 'count' ); ?>"<?php checked( $count ); ?> />
				<label
					for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show product counts', 'post-type-x' ); ?></label><br/>

				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'hierarchical' ); ?>"
					   name="<?php echo $this->get_field_name( 'hierarchical' ); ?>"<?php checked( $hierarchical ); ?> />
				<label
					for="<?php echo $this->get_field_id( 'hierarchical' ); ?>"><?php _e( 'Show hierarchy', 'post-type-x' ); ?></label>
					<?php
					$object			 = $this;
					do_action( 'product_categories_widget_settings', $instance, $object );
					?> </p> <?php
		} else {
			//implecode_warning( sprintf( __( '%s is disabled due to a lack of main catalog listing.%s', 'post-type-x' ), __( 'Category widget', 'post-type-x' ), ic_catalog_notices::create_listing_page_button() ) );
			ic_catalog_notices::simple_mode_notice();
		}
	}

	function add_category_parent_css( $css_classes, $category, $depth, $args ) {
		if ( $args[ 'has_children' ] ) {
			$css_classes[] = 'has_children';
		}
		return $css_classes;
	}

}

class ic_cat_Walker_CategoryDropdown extends Walker_CategoryDropdown {

	function start_el( &$output, $category, $depth = 0, $args = Array(), $id = 0 ) {
		$pad = str_repeat( '&nbsp;', $depth * 3 );

		$cat_name	 = apply_filters( 'list_cats', $category->name, $category );
		$output		 .= "\t<option class=\"level-$depth\" value=\"" . $category->slug . "\"";
		if ( $category->slug == get_query_var( 'al_product-cat' ) ) {
			$output .= ' selected="selected"';
		}
		$output	 .= '>';
		$output	 .= $pad . $cat_name;
		if ( !empty( $args[ 'show_count' ] ) ) {
			$output .= '&nbsp;&nbsp;(' . $category->count . ')';
		}
		if ( isset( $args[ 'show_last_update' ] ) ) {
			$format	 = 'Y-m-d';
			$output	 .= '&nbsp;&nbsp;' . gmdate( $format, $category->last_update_timestamp );
		}
		$output .= "</option>\n";
	}

}

add_action( 'wp', 'ic_category_none_redirect' );

function ic_category_none_redirect() {
	if ( is_ic_product_listing_enabled() && isset( $_GET[ 'al_product-cat' ] ) && $_GET[ 'al_product-cat' ] === "-1" ) {
		$listing_url = product_listing_url();
		if ( !empty( $listing_url ) ) {
			wp_redirect( $listing_url );
			exit;
		}
	}
}
