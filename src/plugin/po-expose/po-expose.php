<?php
/**
 * @package sirna-po15
 * @subpackage po-expose
 * @version 0.0.0
 */
/*
Plugin Name: PO Expose
Plugin URI: http://github.com/zabkasirna/patrickowen
Description: Plugin for Expose Custom Post
Author: Sirna
Version: 0.0.0
Author URI: http://github.com/zabkasirna
*/

// Register Custom Post Type
function register_cpt_exposes() {

    $labels = array(
        'name'                => _x( 'Exposes', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Expose', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Expose', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Expose:', 'text_domain' ),
        'all_items'           => __( 'All Exposes', 'text_domain' ),
        'view_item'           => __( 'View Expose', 'text_domain' ),
        'add_new_item'        => __( 'Add New Expose', 'text_domain' ),
        'add_new'             => __( 'Add New Exposes', 'text_domain' ),
        'edit_item'           => __( 'Edit Expose', 'text_domain' ),
        'update_item'         => __( 'Update Expose', 'text_domain' ),
        'search_items'        => __( 'Search Expose', 'text_domain' ),
        'not_found'           => __( 'Expose Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Expose Not found in Trash', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'expose',
        'with_front'          => true,
        'pages'               => false,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'expose', 'text_domain' ),
        'description'         => __( 'Expose CPT', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', ),
        'taxonomies'          => array( 'Seasons' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-images-alt2',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'query_var'           => 'expose',
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );
    register_post_type( 'expose', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_cpt_exposes', 0 );

/**
 * Include the template files from the plugin dir
 * [http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives--wp-27898]
 */

function include_expose_template( $template_path ) {

    if ( get_post_type() == 'expose' ) {

        // Include single template
        if ( is_single() ) {

            if ( $theme_file = locate_template( array( 'single-expose.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/single-expose.php';
            }
        }

        // Include archive template
        elseif ( is_archive() ) {

            if ( $theme_file = locate_template( array( 'archive-expose.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/archive-expose.php';
            }
        }
    }

    return $template_path;
}

add_filter( 'template_include', 'include_expose_template', 1 );

?>
