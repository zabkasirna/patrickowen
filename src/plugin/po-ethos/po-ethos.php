<?php
/**
 * @package sirna-po15
 * @subpackage po-ethos
 * @version 0.0.0
 */
/*
Plugin Name: PO Ethos
Plugin URI: http://github.com/zabkasirna/patrickowen
Description: Plugin for Ethos Custom Post
Author: Sirna
Version: 0.0.0
Author URI: http://github.com/zabkasirna
*/

// Register Custom Post Type
function register_cpt_ethoss() {

    $labels = array(
        'name'                => _x( 'Ethoss', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Ethos', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Ethos', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Ethos:', 'text_domain' ),
        'all_items'           => __( 'All Ethoss', 'text_domain' ),
        'view_item'           => __( 'View Ethos', 'text_domain' ),
        'add_new_item'        => __( 'Add New Ethos', 'text_domain' ),
        'add_new'             => __( 'Add New Ethoss', 'text_domain' ),
        'edit_item'           => __( 'Edit Ethos', 'text_domain' ),
        'update_item'         => __( 'Update Ethos', 'text_domain' ),
        'search_items'        => __( 'Search Ethos', 'text_domain' ),
        'not_found'           => __( 'Ethos Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Ethos Not found in Trash', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'ethos',
        'with_front'          => true,
        'pages'               => false,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'ethos', 'text_domain' ),
        'description'         => __( 'Ethos CPT', 'text_domain' ),
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
        'query_var'           => 'ethos',
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );
    register_post_type( 'ethos', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_cpt_ethoss', 0 );

/**
 * Include the template files from the plugin dir
 * [http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives--wp-27898]
 */

function include_ethos_template( $template_path ) {

    if ( get_post_type() == 'ethos' ) {

        // Include single template
        if ( is_single() ) {

            if ( $theme_file = locate_template( array( 'single-ethos.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/single-ethos.php';
            }
        }

        // Include archive template
        elseif ( is_archive() ) {

            if ( $theme_file = locate_template( array( 'archive-ethos.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/archive-ethos.php';
            }
        }
    }

    return $template_path;
}

add_filter( 'template_include', 'include_ethos_template', 1 );

?>
