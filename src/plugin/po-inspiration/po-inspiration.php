<?php
/**
 * @package sirna-po15
 * @subpackage po-inspiration
 * @version 0.0.0
 */
/*
Plugin Name: PO Inspiration
Plugin URI: http://github.com/zabkasirna/patrickowen
Description: Plugin for Inspiration Custom Post
Author: Sirna
Version: 0.0.0
Author URI: http://github.com/zabkasirna
*/

// Register Custom Post Type
function register_cpt_inspirations() {

    $labels = array(
        'name'                => _x( 'Inspirations', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Inspiration', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Inspiration', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Inspiration:', 'text_domain' ),
        'all_items'           => __( 'All Inspirations', 'text_domain' ),
        'view_item'           => __( 'View Inspiration', 'text_domain' ),
        'add_new_item'        => __( 'Add New Inspiration', 'text_domain' ),
        'add_new'             => __( 'Add New Inspirations', 'text_domain' ),
        'edit_item'           => __( 'Edit Inspiration', 'text_domain' ),
        'update_item'         => __( 'Update Inspiration', 'text_domain' ),
        'search_items'        => __( 'Search Inspiration', 'text_domain' ),
        'not_found'           => __( 'Inspiration Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Inspiration Not found in Trash', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'inspiration',
        'with_front'          => true,
        'pages'               => false,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'inspiration', 'text_domain' ),
        'description'         => __( 'Inspiration CPT', 'text_domain' ),
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
        'menu_icon'           => 'dashicons-format-aside',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'query_var'           => 'inspiration',
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );
    register_post_type( 'inspiration', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_cpt_inspirations', 0 );

/**
 * Include the template files from the plugin dir
 * [http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives--wp-27898]
 */

function include_inspiration_template( $template_path ) {

    if ( get_post_type() == 'inspiration' ) {

        // Include single template
        if ( is_single() ) {

            if ( $theme_file = locate_template( array( 'single-inspiration.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/single-inspiration.php';
            }
        }

        // Include archive template
        elseif ( is_archive() ) {

            if ( $theme_file = locate_template( array( 'archive-inspiration.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/archive-inspiration.php';
            }
        }
    }

    return $template_path;
}

add_filter( 'template_include', 'include_inspiration_template', 1 );

?>
