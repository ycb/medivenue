<?php
function my_theme_enqueue_styles() {

    $parent_style = 'hestia_style'; // This is 'hestia_style' for the Hestia theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type > Procedures
    $labels = array(
        'name'                => _x( 'Procedures', 'Post Type General Name', 'hestia-child' ),
        'singular_name'       => _x( 'Procedure', 'Post Type Singular Name', 'hestia-child' ),
        'menu_name'           => __( 'Procedures', 'hestia-child' ),
        'parent_item_colon'   => __( 'Parent Procedure', 'hestia-child' ),
        'all_items'           => __( 'All Procedures', 'hestia-child' ),
        'view_item'           => __( 'View Procedure', 'hestia-child' ),
        'add_new_item'        => __( 'Add New Procedure', 'hestia-child' ),
        'add_new'             => __( 'Add New', 'hestia-child' ),
        'edit_item'           => __( 'Edit Procedure', 'hestia-child' ),
        'update_item'         => __( 'Update Procedure', 'hestia-child' ),
        'search_items'        => __( 'Search Procedure', 'hestia-child' ),
        'not_found'           => __( 'Not Found', 'hestia-child' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'hestia-child' ),
    );
    

// Set other options for Custom Post Type > Procedures

     
    $args = array(
        'label'               => __( 'procedures', 'hestia-child' ),
        'description'         => __( 'procedure details', 'hestia-child' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'category' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_admin_column'          => true,
      );
     


    // Registering your Custom Post Type > Procedures
    register_post_type( 'Procedures', $args );

}

 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. ENABLE CPT CATEGORIES ALONGSIDE POST CATEGORIES
*/

add_action( 'init', 'custom_post_type', 0 );


add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
 
function add_my_post_types_to_query( $query ) {
    if ( is_category() && $query->is_main_query() )
        $query->set( 'post_type', array( 'nav_menu_item', 'post', 'procedures' ) );
    return $query;
}



?>