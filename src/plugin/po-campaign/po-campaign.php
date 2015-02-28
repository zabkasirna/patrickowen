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
function register_cpt_campaigns() {
 
    $labels = array( 
        'name' => _x( 'campaign', 'campaigns' ),
        'singular_name' => _x( 'campaigns', 'campaigns' ),
        'add_new' => _x( 'Add New', 'campaigns' ),
        'add_new_item' => _x( 'Add New Campaigns', 'campaigns' ),
        'edit_item' => _x( 'Edit Campaigns', 'campaigns' ),
        'new_item' => _x( 'New Campaigns', 'campaigns' ),
        'view_item' => _x( 'View Campaigns', 'campaigns' ),
        'search_items' => _x( 'Search Campaign', 'campaigns' ),
        'not_found' => _x( 'No campaign found', 'campaigns' ),
        'not_found_in_trash' => _x( 'No campaign found in Trash', 'campaigns' ),
        'parent_item_colon' => _x( 'Parent Campaigns:', 'campaigns' ),
        'menu_name' => _x( 'Campaign', 'Campaigns' ),
    );
 
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'campaign custom post',
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'campaign_season' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'campaign', $args );
}
 
add_action( 'init', 'register_cpt_campaigns' );
 
function register_taxonomy_campaign_season() {

    $labels = array( 
        'name' => _x( 'campaign-seasons', 'seasons' ),
        'singular_name' => _x( 'campaign-season', 'seasons' ),
        'search_items' => _x( 'Search seasons', 'seasons' ),
        'popular_items' => _x( 'Popular seasons', 'seasons' ),
        'all_items' => _x( 'All seasons', 'seasons' ),
        'parent_item' => _x( 'Parent campaign-season', 'seasons' ),
        'parent_item_colon' => _x( 'Parent campaign-season:', 'seasons' ),
        'edit_item' => _x( 'Edit season', 'seasons' ),
        'update_item' => _x( 'Update season', 'seasons' ),
        'add_new_item' => _x( 'Add New season', 'seasons' ),
        'new_item_name' => _x( 'New season', 'seasons' ),
        'separate_items_with_commas' => _x( 'Separate campaign-seasons with commas', 'seasons' ),
        'add_or_remove_items' => _x( 'Add or remove seasons', 'seasons' ),
        'choose_from_most_used' => _x( 'Choose from most used seasons', 'seasons' ),
        'menu_name' => _x( 'Seasons', 'Seasons' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => false,
        'update_count_callback' => 'season_count_update_cb',
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'campaign_season', array('campaign'), $args );
}

add_action( 'init', 'register_taxonomy_campaign_season' );

function create_campaign_pages()
  {
   //post status and options
    $post = array(
          'post_name' => 'campaign',
          'post_type' => 'post',
          'post_title' => wp_strip_all_tags( $_POST['post_title'] ),
          'post_date' => date('Y-m-d H:i:s'),
          'ping_status' =>  'closed' ,
          'comment_status' => 'closed'
    );
    //insert page and save the id
    $newvalue = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'campaignpage', $newvalue );
  }

register_activation_hook( __FILE__, 'create_campaign_pages');

?>