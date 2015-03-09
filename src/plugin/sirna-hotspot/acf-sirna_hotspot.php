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

// Include field type for ACF4
function register_fields_sirna_hotspot() {
    include_once('acf-sirna_hotspot-v4.php');
}

add_action('acf/register_fields', 'register_fields_sirna_hotspot'); 
?>