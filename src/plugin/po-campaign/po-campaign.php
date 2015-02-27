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
function register_campaign_cpt() {
 
    $labels = array(
        'name' => _x( 'Campaign', 'campaign' ),
        'singular_name' => _x( 'Music Review', 'campaign' ),
        'add_new' => _x( 'Add New', 'campaign' ),
        'add_new_item' => _x( 'Add New Music Review', 'campaign' ),
        'edit_item' => _x( 'Edit Music Review', 'campaign' ),
        'new_item' => _x( 'New Music Review', 'campaign' ),
        'view_item' => _x( 'View Music Review', 'campaign' ),
        'search_items' => _x( 'Search Campaign', 'campaign' ),
        'not_found' => _x( 'No Campaign found', 'campaign' ),
        'not_found_in_trash' => _x( 'No Campaign found in Trash', 'campaign' ),
        'parent_item_colon' => _x( 'Parent Music Review:', 'campaign' ),
        'menu_name' => _x( 'Campaign', 'campaign' ),
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Campaign filterable by genre',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'campaign_season' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-audio',
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
 
add_action( 'init', 'register_campaign_cpt' );
 
function campaign_season_taxonomy() {
    register_taxonomy(
        'campaign_season',
        'campaign',
        array(
            'hierarchical' => true,
            'label' => 'Season',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'genre',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'campaign_season_taxonomy');

function create_campaign_pages()
  {
   //post status and options
    $post = array(
          'comment_status' => 'closed',
          'ping_status' =>  'closed' ,
          'post_date' => date('Y-m-d H:i:s'),
          'post_name' => 'campaign',
          'post_title' => 'Campaign',
          'post_type' => 'page',
    );
    //insert page and save the id
    $newvalue = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'campaignpage', $newvalue );
  }

register_activation_hook( __FILE__, 'create_campaign_pages');

?>