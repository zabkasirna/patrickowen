<?php
/**
 * @package sirna-po15
 * @subpackage po-campaign
 * @version 0.0.0
 */
/*
Plugin Name: PO Season
Plugin URI: http://github.com/zabkasirna/patrickowen
Description: Plugin for Season Custom Taxonomy
Author: Sirna
Version: 0.0.0
Author URI: http://github.com/zabkasirna
*/

// Register Custom Taxonomy
function register_taxonomy_season() {

    $labels = array(
        'name'                       => _x( 'Seasons', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Season', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Seasons', 'text_domain' ),
        'all_items'                  => __( 'All Seasons', 'text_domain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'new_item_name'              => __( 'New Item Seasons', 'text_domain' ),
        'add_new_item'               => __( 'Add New Season', 'text_domain' ),
        'edit_item'                  => __( 'Edit Season', 'text_domain' ),
        'update_item'                => __( 'Update Season', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate seasons with commas', 'text_domain' ),
        'search_items'               => __( 'Search Seasons', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove Seasons', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Seasons', 'text_domain' ),
        'not_found'                  => __( 'No Seasons Found', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'season',
        'update_count_callback'      => 'update_season_count_cb'   );
    register_taxonomy( 'season', array( 'post', 'campaign', 'lookbook', 'catwalk', 'scarve', 'inspiration', 'expose' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_taxonomy_season', 0 );

?>
