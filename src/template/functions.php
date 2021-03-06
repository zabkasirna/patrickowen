<?php
/**
 * @author Sirna <https://github.com/zabkasirna>
 * @since 0.0.0
 */

// Load Sirna debugger
// @todo make this automatically detect dev env
require_once( 'printrr.php' );

// Load theme's core
require_once( 'sirna-po15.php' );

// Conf at theme launch
function po_conf() {

    // Head cleanup
    add_action( 'init', 'po_head_cleanup' );

    // Menu
    add_action( 'init', 'register_po_nav_menus' );

    // Remove wp version from rss
    add_filter( 'the_generator', 'po_rss_version' );

    // Enqueue scripts & styles
    add_action( 'wp_enqueue_scripts', 'po_scripts_and_styles', 999 );

    // Modify post queue
    // add_filter( 'pre_get_posts', 'get_campaign_for_home' );

    // theme support after theme setup
    po_theme_support();

    // clean up random code around images
    add_filter( 'the_content', 'po_filter_ptags_on_images' );
}

add_action( 'after_setup_theme', 'po_conf' );

/** Navigation */
function toggle_nav_class( $classes, $item ) {
    if ( in_array( 'current-menu-item', $classes ) ) {
        $classes[] = 'active';
    }

    return $classes;
}

add_filter( 'nav_menu_css_class', 'toggle_nav_class', 10, 2 );

/**
 * Woocommerce
 */

add_action( 'after_setup_theme', 'powc_cleanup' );

/**
 * Hotspot
 */

add_action( 'admin_enqueue_scripts', 'po_admin_scripts_and_styles' );

/** Debugger */
add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}
?>