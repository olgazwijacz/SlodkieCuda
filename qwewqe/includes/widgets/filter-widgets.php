<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Manages product search widget
 *
 * Here product search widget is defined.
 *
 * @version		1.4.0
 * @package		post-type-x/core/includes
 * @author 		impleCode
 */
add_action( 'widgets_init', 'register_product_filter_bar', 30 );

function register_product_filter_bar() {
	if ( is_plural_form_active() ) {
		$names		 = get_catalog_names();
		$label		 = sprintf( __( '%s Filters Bar', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
		$sublabel	 = sprintf( __( 'Appears above the product list. Recommended widgets: %1$s Search, %1$s Price Filter, %1$s Sort and %1$s Category Filter.', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
	} else {
		$label		 = __( 'Catalog Filters Bar', 'post-type-x' );
		$sublabel	 = __( 'Appears above the product list. Recommended widgets: Catalog Search, Catalog Price Filter, Catalog Sort and Catalog Category Filter.', 'post-type-x' );
	}
	$args = array(
		'name'			 => $label,
		'id'			 => 'product_sort_bar',
		'description'	 => $sublabel,
		'class'			 => '',
		'before_widget'	 => '<div id="%1$s" class="filter-widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h2 class="filter-widget-title">',
		'after_title'	 => '</h2>' );
	register_sidebar( $args );
}

function ic_if_show_filter_widget( $instance = null ) {
	if ( ic_is_rendering_catalog_block() || (!empty( $instance[ 'shortcode_support' ] ) && (has_show_products_shortcode() || ic_is_rendering_products_block())) || (!is_ic_shortcode_query() && (is_ic_ajax() || ((is_ic_taxonomy_page() || is_ic_product_listing() || is_ic_product_search()))) ) ) {
		return true;
	}
	return false;
}

class product_category_filter extends WP_Widget {

	function __construct() {
		if ( is_plural_form_active() ) {
			$names		 = get_catalog_names();
			$label		 = sprintf( __( '%s Category Filter', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
			$sublabel	 = sprintf( __( 'Filter %s by categories.', 'post-type-x' ), ic_lcfirst( $names[ 'plural' ] ) );
		} else {
			$label		 = __( 'Catalog Category Filter', 'post-type-x' );
			$sublabel	 = __( 'Filter items by categories.', 'post-type-x' );
		}
		$widget_ops = array( 'classname' => 'product_category_filter', 'description' => $sublabel );
		parent::__construct( 'product_category_filter', $label, $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( get_integration_type() != 'simple' ) {
			if ( ic_if_show_filter_widget( $instance ) ) {
				global $shortcode_query;
				$title		 = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );
				$taxonomy	 = get_current_screen_tax();
				$post_ids	 = null;
				if ( !empty( $instance[ 'shortcode_support' ] ) && !is_ic_product_listing() && has_show_products_shortcode() ) {
					if ( !empty( $shortcode_query ) ) {
						$post_ids = wp_list_pluck( $shortcode_query->posts, 'ID' );
					}
				}
				if ( is_ic_taxonomy_page() && !is_product_filter_active( 'product_category' ) ) {
					$categories = get_terms( $taxonomy, array( 'parent' => get_queried_object()->term_id ) );
				} else if ( !empty( $instance[ 'shortcode_support' ] ) && !is_ic_product_listing() && has_show_products_shortcode() && !is_product_filter_active( 'product_category' ) ) {
					$parent = isset( $shortcode_query->query_vars[ 'term_id' ] ) ? $shortcode_query->query_vars[ 'term_id' ] : 0;
					if ( empty( $parent ) ) {
						$categories = wp_get_object_terms( $post_ids, $taxonomy );
					} else {
						$categories = get_terms( $taxonomy, array( 'parent' => $parent ) );
					}
				} else {
					$categories = get_terms( $taxonomy, array( 'parent' => 0 ) );
				}
				$form			 = '';
				$child_form		 = '';
				$category_ids	 = wp_list_pluck( $categories, 'term_id' );
				foreach ( $categories as $category ) {
					if ( $category->parent && in_array( $category->parent, $category_ids ) ) {
						continue;
					}
					$form .= get_product_category_filter_element( $category, $post_ids );
				}
				$class = 'product-category-filter-container';
				if ( is_product_filter_active( 'product_category' ) ) {
					$class			 .= ' filter-active';
					$filter_value	 = get_product_filter_value( 'product_category' );
					$children		 = get_terms( $taxonomy, array( 'parent' => $filter_value ) );
					//if ( !is_ic_taxonomy_page() ) {
					$parent_term	 = get_term_by( 'id', $filter_value, $taxonomy );
					if ( !empty( $parent_term->parent ) ) {
						$form .= get_product_category_filter_element( $parent_term, $post_ids );
					}
					//}
					if ( is_array( $children ) ) {
						foreach ( $children as $child ) {
							$child_form .= get_product_category_filter_element( $child, $post_ids );
						}
					}
				}
				if ( !empty( $form ) || !empty( $child_form ) ) {
					echo $args[ 'before_widget' ];
					if ( $title ) {
						echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
					}
					echo '<div class="' . $class . ' ic_ajax" data-ic_responsive_label="' . __( 'Category', 'ecommerce-product-cataolog' ) . '" data-ic_ajax="product-category-filter-container">';
					echo $form;
					if ( !empty( $child_form ) ) {
						echo '<div class="child-category-filters">' . $child_form . '</div>';
					}
					echo '</div>';
					echo $args[ 'after_widget' ];
				}
			}
		}
	}

	function form( $instance ) {
		if ( get_integration_type() != 'simple' ) {
			$instance	 = wp_parse_args( (array) $instance, array( 'title' => '', 'shortcode_support' => 0 ) );
			$title		 = $instance[ 'title' ];
			?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'post-type-x' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'shortcode_support' ); ?>" name="<?php echo $this->get_field_name( 'shortcode_support' ); ?>" type="checkbox" value="1" <?php checked( 1, $instance[ 'shortcode_support' ] ) ?> /> <label for="<?php echo $this->get_field_id( 'shortcode_support' ); ?>"><?php _e( 'Enable also for shortcodes', 'post-type-x' ); ?></label></p><?php
		} else {
			//implecode_warning( sprintf( __( '%s is disabled due to a lack of main catalog listing.%s', 'post-type-x' ), __( 'Category filter', 'post-type-x' ), ic_catalog_notices::create_listing_page_button() ) );
			ic_catalog_notices::simple_mode_notice();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance						 = $old_instance;
		$new_instance					 = wp_parse_args( (array) $new_instance, array( 'title' => '', 'shortcode_support' => 0 ) );
		$instance[ 'title' ]			 = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'shortcode_support' ] = intval( $new_instance[ 'shortcode_support' ] );
		return $instance;
	}

}

class product_sort_filter extends WP_Widget {

	function __construct() {
		if ( is_plural_form_active() ) {
			$names		 = get_catalog_names();
			$label		 = sprintf( __( '%s Sort', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
			$sublabel	 = sprintf( __( 'Sort %s dropdown.', 'post-type-x' ), ic_lcfirst( $names[ 'plural' ] ) );
		} else {
			$label		 = __( 'Catalog Sort', 'post-type-x' );
			$sublabel	 = __( 'Sort catalog items dropdown.', 'post-type-x' );
		}
		$widget_ops = array( 'classname' => 'product_sort_filter', 'description' => $sublabel );
		parent::__construct( 'product_sort_filter', $label, $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( get_integration_type() != 'simple' ) {
			if ( ic_if_show_filter_widget( $instance ) ) {

				$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

				echo $args[ 'before_widget' ];
				if ( $title ) {
					echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
				}

				// Use current theme search form if it exists
				show_product_order_dropdown( null, null, $instance );
				echo $args[ 'after_widget' ];
			}
		}
	}

	function form( $instance ) {
		if ( get_integration_type() != 'simple' ) {
			$instance	 = wp_parse_args( (array) $instance, array( 'title' => '', 'shortcode_support' => 0 ) );
			$title		 = $instance[ 'title' ];
			?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'post-type-x' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'shortcode_support' ); ?>" name="<?php echo $this->get_field_name( 'shortcode_support' ); ?>" type="checkbox" value="1" <?php checked( 1, $instance[ 'shortcode_support' ] ) ?> /> <label for="<?php echo $this->get_field_id( 'shortcode_support' ); ?>"><?php _e( 'Enable also for shortcodes', 'post-type-x' ); ?></label></p><?php
		} else {
			//implecode_warning( sprintf( __( '%s is disabled due to a lack of main catalog listing.%s', 'post-type-x' ), __( 'Sort widget', 'post-type-x' ), ic_catalog_notices::create_listing_page_button() ) );
			ic_catalog_notices::simple_mode_notice();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance						 = $old_instance;
		$new_instance					 = wp_parse_args( (array) $new_instance, array( 'title' => '', 'shortcode_support' => 0 ) );
		$instance[ 'title' ]			 = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'shortcode_support' ] = intval( $new_instance[ 'shortcode_support' ] );
		return $instance;
	}

}

class ic_product_size_filter extends WP_Widget {

	function __construct() {
		if ( is_plural_form_active() ) {
			$names		 = get_catalog_names();
			$label		 = sprintf( __( '%s Size Filter', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
			$sublabel	 = sprintf( __( 'Filter %s by size.', 'post-type-x' ), ic_lcfirst( $names[ 'plural' ] ) );
		} else {
			$label		 = __( 'Catalog Size Filter', 'post-type-x' );
			$sublabel	 = __( 'Filter items by size.', 'post-type-x' );
		}
		$classname = 'product_size_filter';
		if ( is_product_filter_active( '_size_length' ) ) {
			$classname .= ' active';
		}
		$widget_ops = array( 'classname' => $classname, 'description' => $sublabel );
		parent::__construct( 'ic_product_size_filter', $label, $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( get_integration_type() != 'simple' ) {
			if ( ic_if_show_filter_widget( $instance ) && function_exists( 'ic_size_field_names' ) ) {
				$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

				echo $args[ 'before_widget' ];
				if ( $title ) {
					echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
				}
				do_action( 'ic_size_widget_before_sliders', $instance );
				echo '<form class="product-size-filter-container toReload ic_ajax" data-ic_responsive_label="' . __( 'Size', 'post-type-x' ) . '" data-ic_ajax="product-size-filter-container" action="' . get_filter_widget_action( $instance ) . '">';
				$hidden_fields = array_keys( ic_size_field_names() );
				echo ic_get_to_hidden_field( $_GET, $hidden_fields );
				$this->size_filters();
				echo '</form>';
				echo $args[ 'after_widget' ];
			}
		}
	}

	function size_filters() {
		do_action( 'ic_size_filters' );
	}

	function form( $instance ) {
		if ( get_integration_type() != 'simple' ) {
			$instance	 = wp_parse_args( (array) $instance, array( 'title' => '', 'shortcode_support' => 0 ) );
			$title		 = $instance[ 'title' ];
			?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'post-type-x' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'shortcode_support' ); ?>" name="<?php echo $this->get_field_name( 'shortcode_support' ); ?>" type="checkbox" value="1" <?php checked( 1, $instance[ 'shortcode_support' ] ) ?> /> <label for="<?php echo $this->get_field_id( 'shortcode_support' ); ?>"><?php _e( 'Enable also for shortcodes', 'post-type-x' ); ?></label></p><?php
			do_action( 'ic_size_filter_widget_form', $instance, $this );
		} else {
			//implecode_warning( sprintf( __( '%s is disabled due to a lack of main catalog listing.%s', 'post-type-x' ), __( 'Size filter', 'post-type-x' ), ic_catalog_notices::create_listing_page_button() ) );
			ic_catalog_notices::simple_mode_notice();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance						 = $old_instance;
		$new_instance					 = wp_parse_args( (array) $new_instance, array( 'title' => '', 'shortcode_support' => 0 ) );
		$instance[ 'title' ]			 = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'shortcode_support' ] = intval( $new_instance[ 'shortcode_support' ] );
		return apply_filters( 'ic_size_widget_save', $instance, $new_instance );
	}

}

add_action( 'implecode_register_widgets', 'register_filter_widgets' );

function register_filter_widgets() {
	register_widget( 'product_category_filter' );
	register_widget( 'product_sort_filter' );
	register_widget( 'ic_product_size_filter' );
}

/**
 * Defines form action for filter widget
 *
 * @global type $post
 * @param type $instance
 * @return string
 */
function get_filter_widget_action( $instance ) {
	if ( (!empty( $instance[ 'shortcode_support' ] ) && has_show_products_shortcode()) || is_ic_taxonomy_page() ) {
		$action = '';
	} else {
		$action = apply_filters( 'ic_product_listing_widget_action', product_listing_url() );
	}
	return $action;
}
