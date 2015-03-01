<?php
/**
 * @package sirna-po15
 * @subpackage po-lookbook
 * @version 0.0.0
 */
/*
Plugin Name: PO Lookbook
Plugin URI: http://github.com/zabkasirna/patrickowen
Description: Plugin for Lookbook Custom Post
Author: Sirna
Version: 0.0.0
Author URI: http://github.com/zabkasirna
*/

// Register Custom Post Type
function register_cpt_lookbooks() {

    $labels = array(
        'name'                => _x( 'Lookbooks', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Lookbook', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Lookbook', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Lookbook:', 'text_domain' ),
        'all_items'           => __( 'All Lookbooks', 'text_domain' ),
        'view_item'           => __( 'View Lookbook', 'text_domain' ),
        'add_new_item'        => __( 'Add New Lookbook', 'text_domain' ),
        'add_new'             => __( 'Add New Lookbooks', 'text_domain' ),
        'edit_item'           => __( 'Edit Lookbook', 'text_domain' ),
        'update_item'         => __( 'Update Lookbook', 'text_domain' ),
        'search_items'        => __( 'Search Lookbook', 'text_domain' ),
        'not_found'           => __( 'Lookbook Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Lookbook Not found in Trash', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'lookbook',
        'with_front'          => true,
        'pages'               => false,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'lookbook', 'text_domain' ),
        'description'         => __( 'Lookbook CPT', 'text_domain' ),
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
        'query_var'           => 'lookbook',
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );
    register_post_type( 'lookbook', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_cpt_lookbooks', 0 );

/**
 * Include the template files from the plugin dir
 * [http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives--wp-27898]
 */

function include_lookbook_template( $template_path ) {

    if ( get_post_type() == 'lookbook' ) {

        // Include single template
        if ( is_single() ) {

            if ( $theme_file = locate_template( array( 'single-lookbook.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/single-lookbook.php';
            }
        }

        // Include archive template
        elseif ( is_archive() ) {

            if ( $theme_file = locate_template( array( 'archive-lookbook.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/archive-lookbook.php';
            }
        }
    }
    
    return $template_path;
}

add_filter( 'template_include', 'include_lookbook_template', 1 );

?>
