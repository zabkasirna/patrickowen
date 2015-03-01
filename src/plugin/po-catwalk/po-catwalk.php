<?php
/**
 * @package sirna-po15
 * @subpackage po-catwalk
 * @version 0.0.0
 */
/*
Plugin Name: PO Catwalk
Plugin URI: http://github.com/zabkasirna/patrickowen
Description: Plugin for Catwalk Custom Post
Author: Sirna
Version: 0.0.0
Author URI: http://github.com/zabkasirna
*/

// Register Custom Post Type
function register_cpt_catwalks() {

    $labels = array(
        'name'                => _x( 'Catwalks', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Catwalk', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Catwalk', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Catwalk:', 'text_domain' ),
        'all_items'           => __( 'All Catwalks', 'text_domain' ),
        'view_item'           => __( 'View Catwalk', 'text_domain' ),
        'add_new_item'        => __( 'Add New Catwalk', 'text_domain' ),
        'add_new'             => __( 'Add New Catwalks', 'text_domain' ),
        'edit_item'           => __( 'Edit Catwalk', 'text_domain' ),
        'update_item'         => __( 'Update Catwalk', 'text_domain' ),
        'search_items'        => __( 'Search Catwalk', 'text_domain' ),
        'not_found'           => __( 'Catwalk Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Catwalk Not found in Trash', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'catwalk',
        'with_front'          => true,
        'pages'               => false,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'catwalk', 'text_domain' ),
        'description'         => __( 'Catwalk CPT', 'text_domain' ),
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
        'query_var'           => 'catwalk',
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );
    register_post_type( 'catwalk', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_cpt_catwalks', 0 );

/**
 * Include the template files from the plugin dir
 * [http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives--wp-27898]
 */

function include_catwalk_template( $template_path ) {

    if ( get_post_type() == 'catwalk' ) {

        // Include single template
        if ( is_single() ) {

            if ( $theme_file = locate_template( array( 'single-catwalk.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/single-catwalk.php';
            }
        }

        // Include archive template
        elseif ( is_archive() ) {

            if ( $theme_file = locate_template( array( 'archive-catwalk.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/archive-catwalk.php';
            }
        }
    }

    return $template_path;
}

add_filter( 'template_include', 'include_catwalk_template', 1 );

?>
