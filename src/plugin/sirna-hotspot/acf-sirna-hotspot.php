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




// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-sirna_hotspot', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
// function include_field_types_sirna_hotspot( $version ) {
	
// 	include_once('acf-sirna_hotspot-v5.php');
	
// }

// add_action('acf/include_field_types', 'include_field_types_sirna_hotspot');




// 3. Include field type for ACF4
function register_fields_sirna_hotspot() {
	
	include_once('acf-sirna_hotspot-v4.php');
	
}

add_action('acf/register_fields', 'register_fields_sirna_hotspot');	



	
?>