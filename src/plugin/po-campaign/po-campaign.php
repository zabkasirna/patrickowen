<?php
/**
 * @package sirna-po15
 * @subpackage po-campaign
 * @version 0.0.0
 */
/*
Plugin Name: PO Campaign
Plugin URI: http://github.com/zabkasirna/patrickowen
Description: Plugin for Campaign Custom Post
Author: Sirna
Version: 0.0.0
Author URI: http://github.com/zabkasirna
*/

// Register Custom Post Type
function register_cpt_campaigns() {

    $labels = array(
        'name'                => _x( 'Campaigns', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Campaign', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Campaign', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Campaign:', 'text_domain' ),
        'all_items'           => __( 'All Campaigns', 'text_domain' ),
        'view_item'           => __( 'View Campaign', 'text_domain' ),
        'add_new_item'        => __( 'Add New Campaign', 'text_domain' ),
        'add_new'             => __( 'Add New Campaigns', 'text_domain' ),
        'edit_item'           => __( 'Edit Campaign', 'text_domain' ),
        'update_item'         => __( 'Update Campaign', 'text_domain' ),
        'search_items'        => __( 'Search Campaign', 'text_domain' ),
        'not_found'           => __( 'Campaign Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Campaign Not found in Trash', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'campaign',
        'with_front'          => true,
        'pages'               => false,
        'feeds'               => true,
    );
    $args = array(
        'label'               => __( 'campaign', 'text_domain' ),
        'description'         => __( 'Campaign CPT', 'text_domain' ),
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
        'query_var'           => 'campaign',
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );
    register_post_type( 'campaign', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_cpt_campaigns', 0 );

/**
 * Include the template files from the plugin dir
 * [http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives--wp-27898]
 */

function include_campaign_template() {
    
    if ( get_post_type() == 'campaign' ) {


        // Include single template
        if ( is_single() ) {

            if ( $theme_file = locate_template( array( 'single-campaign.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/single-campaign.php';
            }
        }

        // Include archive template
        else if ( is_archive() ) {

            if ( $theme_file = locate_template( array( 'archive-campaign.php' ) ) ) {
                $template_path = $theme_file;
            }

            else {
                $template_path = plugin_dir_path( __FILE__ ) . 'template/archive-campaign.php';
            }
        }
    }

    return $template_path;
}

add_filter( 'template_include', 'include_campaign_template', 1 );

?>