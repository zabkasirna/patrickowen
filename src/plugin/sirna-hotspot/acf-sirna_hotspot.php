<?php

/*
Plugin Name: Advanced Custom Fields: Sirna Hotspot
Plugin URI: https://github.com/zabkasirna
Description: First attempt on custom ACF, implementing jquery-hotspot
Version: 0.0.1
Author: Sirna
Author URI: https://github.com/zabkasirna
License: proprietary
*/

load_plugin_textdomain( 'acf-sirna_hotspot', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 

// Currently only support v5
function include_field_types_FIELD_NAME( $version ) {
    include_once('acf-sirna_hotspot-v5.php');
}

add_action('acf/include_field_types', 'include_field_types_FIELD_NAME');
?>