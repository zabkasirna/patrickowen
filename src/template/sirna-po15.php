<?php
/**
 * Core Sirna-PO15 file
 * Patterns and Functions taken from:
 * Bones - WP Starter Theme, by Eddie Machado
 * URL: http://themble.com/bones
 */

/**
 * HEAD CLEANUP
 */

function po_head_cleanup() {
    // EditURI link
    remove_action( 'wp_head', 'rsd_link' );
    // windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    // WP version
    remove_action( 'wp_head', 'wp_generator' );
    // remove WP version from css
    add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
    // remove Wp version from scripts
    add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end po15 head cleanup */

// remove WP version from RSS
function po_rss_version() { return ''; }

// remove WP version from scripts
function po_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) ) $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS from gallery
function po_gallery_style($css) {
    return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

/**
 * SCRIPTS & ENQUEUEING
 */

// loading modernizr and jquery, and reply script
function po_scripts_and_styles() {

    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    if (!is_admin()) {

        // jquery
        wp_register_script( 'po-jquery', get_stylesheet_directory_uri() . '/script/vendor/jquery/dist/jquery.js', array(), '', true );

        // modernizr
        wp_register_script( 'po-modernizr', get_stylesheet_directory_uri() . '/script/vendor/modernizr.js', array(), '', false );

        // main stylesheet
        // wp_register_style( 'po-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

        // ie-only stylesheet
        // @todo: Develop ie-only stylesheet
        // wp_register_style( 'po-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

        // adding scripts file in the footer
        // wp_register_script( 'po-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

        // enqueue styles and scripts
        wp_enqueue_script( 'po-modernizr' );
        // wp_enqueue_style( 'po-stylesheet' );
        // wp_enqueue_style( 'po-ie-only' );

        // $wp_styles->add_data( 'po-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

        wp_enqueue_script( 'po-jquery' );
        // wp_enqueue_script( 'po-js' );

    }
}

?>