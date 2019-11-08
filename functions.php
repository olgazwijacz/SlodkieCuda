<?php add_theme_support( 'title-tag' ); ?>
<?php register_nav_menu( 'main', 'Menu główne' ); ?>

<?php 
// Load styles
    function load_stylesheets()
    {
        wp_register_style('styles' , get_template_directory_uri() . '/style.css', array(), 1, 'all');
        wp_enqueue_style('styles');
    }

add_action('wp_enqueue_scripts', 'load_stylesheets');



// Load scripts
function load_js()
{
wp_register_script('java_script' , get_template_directory_uri() . '/js/main.js', array(), 1, 1, 1);
wp_enqueue_script('java_script');
}
?>
<?php add_theme_support('menus'); ?>

 <?php
    register_nav_menus(
        array(

            'top-menu' => __('Top Menu', 'theme'),

        )
    );
    add_theme_support( 'post-thumbnails' );
?>


<?php
/* WYBÓR TORTU*/ 

add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'realizacje',
		'title'         => __( 'Wprowadź nowy tort', 'cmb2' ),
        'object_types'  => array( 'page', ), // Post type
        'show_on'      => array( 'key' => 'page-template', 'value' => 'template-realizacje.php' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Add other metaboxes as needed
    $group_field_id = $cmb->add_field( array(
        'id'          => 'torty',
        'type'        => 'group',
        'description' => __( 'Witaj Anulka! Tutaj dodaj swoje nowe dzieło:)', 'cmb2' ),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __( 'Torcik {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Dodaj kolejny torcik', 'cmb2' ),
            'remove_button'     => __( 'Usuń torcik', 'cmb2' ),
            'sortable'          => true,
            // 'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );
    
    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Nazwa Tortu',
        'id'   => 'nazwa',
        'type' => 'text',
        
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ) );
    
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Krótki opis',
        'description' => 'Tutaj opisz główne cechy tortu',
        'id'   => 'opis',
        'type' => 'textarea_small',
    ) );
    
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Zdjęcie tortu',
        'id'   => 'image',
        'type' => 'file',
    ) );
    
/* WYBÓR INNEGO WYPIEKU*/ 

   $cmb2 = new_cmb2_box( array(
        'id'            => 'realizacje2',
        'title'         => __( 'Wprowadź nowy wypiek', 'cmb2' ),
        'object_types'  => array( 'page', ), // Post type
        'show_on'      => array( 'key' => 'page-template', 'value' => 'template-realizacje.php' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    // Add other metaboxes as needed
    $group_field_id = $cmb2->add_field( array(
        'id'          => 'inne_wypieki',
        'type'        => 'group',
        'description' => __( 'Witaj Anulka! Tutaj dodaj swoje nowe dzieło, które nie jest tortem tylko np. ciastkiem:)', 'cmb2' ),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __( 'Wypiek {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Dodaj kolejny wypiek', 'cmb2' ),
            'remove_button'     => __( 'Usuń wypiek', 'cmb2' ),
            'sortable'          => true,
            // 'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );
    
    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb2->add_group_field( $group_field_id, array(
        'name' => 'Nazwa Wypieku',
        'id'   => 'nazwa',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ) );
    
    $cmb2->add_group_field( $group_field_id, array(
        'name' => 'Krótki opis',
        'description' => 'Tutaj opisz główne cechy wypieku',
        'id'   => 'opis',
        'type' => 'textarea_small',
    ) );
    
    $cmb2->add_group_field( $group_field_id, array(
        'name' => 'Zdjęcie wypieku',
        'id'   => 'image',
        'type' => 'file',
    ) );
    

    /* Cennik*/ 

   $cmb2 = new_cmb2_box( array(
    'id'            => 'Cennik',
    'title'         => __( 'Stwórz cennik swoich wypieków', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'template-cennik.php' ),
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
) );

// Add other metaboxes as needed
$group_field_id = $cmb2->add_field( array(
    'id'          => 'tabela',
    'type'        => 'group',
    'description' => __( 'Tutaj wprowadź dowolne parametry wg. których będziesz wyceniać swoje cenne torty!', 'cmb2' ),
    // 'repeatable'  => false, // use false if you want non-repeatable group
    'options'     => array(
        'group_title'       => __( 'Tabela {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'        => __( 'Dodaj wiersz', 'cmb2' ),
        'remove_button'     => __( 'Usuń wiersz', 'cmb2' ),
        'sortable'          => true,
        // 'closed'         => true, // true to have the groups closed by default
        // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
    ),
) );

// Id's for group's fields only need to be unique for the group. Prefix is not needed.
$cmb2->add_group_field( $group_field_id, array(
    'name' => 'a',
    'id'   => 'a',
    'type' => 'text',
//'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
) );
$cmb2->add_group_field( $group_field_id, array(
    'name' => 'b',
    'id'   => 'b',
    'type' => 'text',
//'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
) );
$cmb2->add_group_field( $group_field_id, array(
    'name' => 'c',
    'id'   => 'c',
    'type' => 'text',
//'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
) );
$cmb2->add_group_field( $group_field_id, array(
    'name' => 'd',
    'id'   => 'd',
    'type' => 'text',
//'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
   ) );






/* O MNIE*/ 


$cmb2 = new_cmb2_box( array(
    'id'            => 'realizacje2',
    'title'         => __( 'Wprowadź nowy wypiek', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'template-realizacje.php' ),
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
) );

// Add other metaboxes as needed
$group_field_id = $cmb2->add_field( array(
    'id'          => 'inne_wypieki',
    'type'        => 'group',
    'description' => __( 'Witaj Anulka! Tutaj dodaj swoje nowe dzieło, które nie jest tortem tylko np. ciastkiem:)', 'cmb2' ),
    // 'repeatable'  => false, // use false if you want non-repeatable group
    'options'     => array(
        'group_title'       => __( 'Wypiek {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'        => __( 'Dodaj kolejny wypiek', 'cmb2' ),
        'remove_button'     => __( 'Usuń wypiek', 'cmb2' ),
        'sortable'          => true,
        // 'closed'         => true, // true to have the groups closed by default
        // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
    ),
) );

// Id's for group's fields only need to be unique for the group. Prefix is not needed.
$cmb2->add_group_field( $group_field_id, array(
    'name' => 'Nazwa Wypieku',
    'id'   => 'nazwa',
    'type' => 'text',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
) );

$cmb2->add_group_field( $group_field_id, array(
    'name' => 'Krótki opis',
    'description' => 'Tutaj opisz główne cechy wypieku',
    'id'   => 'opis',
    'type' => 'textarea_small',
) );

$cmb2->add_group_field( $group_field_id, array(
    'name' => 'Zdjęcie wypieku',
    'id'   => 'image',
    'type' => 'file',
) );
}
?>