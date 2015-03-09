<?php
/**
 * Core Sirna-PO15 file
 * Patterns and Functions taken from:
 * Bones - WP Starter Theme, by Eddie Machado [http://themble.com/bones]
 * @author Sirna <https://github.com/zabkasirna>
 * @since 0.0.0
 */

// Load Sirna debugger
// @todo make this automatically detect dev env
require_once( 'printrr.php' );

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
    add_filter( 'style_loader_src', 'po_remove_wp_ver_css_js', 9999 );
    // remove Wp version from scripts
    add_filter( 'script_loader_src', 'po_remove_wp_ver_css_js', 9999 );

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

function po_scripts_and_styles() {

    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    if (!is_admin()) {

        // modernizr
        wp_register_script( 'po-modernizr', get_template_directory_uri() . '/script/vendor/modernizr/modernizr.js', array(), '', false );

        // jquery
        wp_register_script( 'po-jquery', get_template_directory_uri() . '/script/vendor/jquery/dist/jquery.js', array(), '', true );

        // waypoints
        wp_register_script( 'po-waypoints', get_template_directory_uri() . '/script/vendor/waypoints/lib/jquery.waypoints.js', array( 'po-jquery' ), '', true );

        // jquery transit
        wp_register_script( 'po-transit', get_template_directory_uri() . '/script/vendor/jquery.transit/jquery.transit.js', array( 'po-jquery' ), '', true );

        // jquery zoom
        wp_register_script( 'po-zoom', get_template_directory_uri() . '/script/vendor/jquery-zoom/jquery.zoom.js', array( 'po-jquery' ), '', true );

        // formstone UI
        wp_register_script( 'po-stepper', get_template_directory_uri() . '/script/vendor/Stepper/jquery.fs.stepper.js', array( 'po-jquery' ), '', true );
        wp_register_script( 'po-selecter', get_template_directory_uri() . '/script/vendor/Selecter/jquery.fs.selecter.js', array( 'po-jquery' ), '', true );

        // site
        wp_register_script( 'po-js', get_template_directory_uri() . '/script/main.js', array( 'po-jquery' ), '', true );

        // enqueue scripts
        wp_enqueue_script( 'po-modernizr' );
        wp_enqueue_script( 'po-jquery' );
        wp_enqueue_script( 'po-waypoints' );
        wp_enqueue_script( 'po-transit' );
        wp_enqueue_script( 'po-stepper' );
        wp_enqueue_script( 'po-selecter' );
        wp_enqueue_script( 'po-zoom' );
        wp_enqueue_script( 'po-js' );

        // main stylesheet
        wp_register_style( 'po-stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );

        // ie-only stylesheet
        // @todo: Develop ie-only stylesheet
        wp_register_style( 'po-stylesheet', get_stylesheet_directory_uri() . '/style.ie.css', array(), '' );

        // enqueue styles
        wp_enqueue_style( 'po-stylesheet' );
        wp_enqueue_style( 'po-ie-only' );

        $wp_styles->add_data( 'po-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
    }
}

/**
 * THEME SUPPORT
 */

function po_theme_support() {


    // wp thumbnails (sizes handled in functions.php)
    add_theme_support( 'post-thumbnails' );

    // image sizes
    set_post_thumbnail_size(1200, 9999);

    // wp rss
    // add_theme_support('automatic-feed-links');
    
    // woocommerce
    add_theme_support( 'woocommerce' );

} /* end po theme support */

/**
 * MENUS
 */

// Register Navigation Menus
function register_po_nav_menus() {

    $locations = array(
        'main-navi' => __( 'Site main navigations', 'text_domain' ),
        'footer-link' => __( 'Site secondary links', 'text_domain' ),
        'cart-link' => __( 'Cart links', 'text_domain' ),
        'socmed-link' => __( 'Social media links', 'text_domain' )
    );
    register_nav_menus( $locations );
}


/**
 * OTHER CLEANUPS
 */

// remove the p from around imgs
// [ http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/ ]
function po_filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/**
 * PO Campaign Plugin
 * [ http://justintadlock.com/archives/2010/02/02/showing-custom-post-types-on-your-home-blog-page ]
 */
// function get_campaign_for_home( $query ) {

//     if ( is_home() && $query->is_main_query() )
//         $query->set( 'post_type', array( 'campaign' ) );

//     return $query;
// }

/**
 * Woocommerce
 */

function powc_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles[ 'woocommerce-general' ] );
    unset( $enqueue_styles[ 'woocommerce-layout' ] );
    unset( $enqueue_styles[ 'woocommerce-smallscreen' ] );

    return $enqueue_styles;
}

function powc_get_product_cat() {
    global $post;

    $the_product_cat = new stdClass();
    $terms = get_the_terms( $post->ID, 'product_cat' );

    if ( $terms ) {
        foreach ($terms as $term) {
            $the_product_cat->slug = $term->slug;

            if ( $term->parent )  {
                $the_product_cat->parent = $terms[ $term->parent ]->slug;
            }

            break;
        }
    }

    return $the_product_cat;
}

function powc_cat_is( $cat ) {
    $test_product = powc_get_product_cat();

    if ( $test_product->slug == $cat || $test_product->parent == $cat ) {
        return 1;
    }
    else {
        return 0;
    }
}

function powc_template_loop_product_thumbnail() {
    echo powc_get_product_thumbnail();
}

function powc_get_product_thumbnail() {
    global $post, $product;

    if ( has_post_thumbnail() ) {

        $attachment_ids = $product->get_gallery_attachment_ids();
        $markup = '';

        $counter = 0;
        foreach( $attachment_ids as $attachment_id ) {
            if ( $counter < 2 ) {
                $img_url = wp_get_attachment_url( $attachment_id );
                $markup .= '<span class="product-heirloom-image-outer"><img class="product-heirloom-image" src="' . $img_url . '" alt="' . $post->post_title . '"></span>';
                $counter++;
            } else { break; }
        }

        return $markup;
    }

    elseif ( wc_placeholder_img_src() ) {
        return wc_placeholder_img( 'shop_catalog' );
    }
}

?>
