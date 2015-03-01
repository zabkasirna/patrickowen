<?php
/**
 * @author Sirna <https://github.com/zabkasirna>
 * @since 0.0.0
 */

// Load theme's core
require_once( 'sirna-po15.php' );

// Conf at theme launch
function po_conf() {

    // Head cleanup
    add_action( 'init', 'po_head_cleanup' );

    // Remove wp version from rss
    add_filter( 'the_generator', 'po_rss_version' );

    // Enqueue scripts & styles
    add_action( 'wp_enqueue_scripts', 'po_scripts_and_styles', 999 );

    // Modify post queue
    add_filter( 'pre_get_posts', 'get_campaign_for_home' );

    // theme support after theme setup
    po_theme_support();

    // clean up random code around images
    add_filter( 'the_content', 'po_filter_ptags_on_images' );
}

add_action( 'after_setup_theme', 'po_conf' );

?>