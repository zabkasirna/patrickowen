<?php

/**
 * ACF Sirna Hotspot Field
 * 
 * A duplicate from ACF Image Field. Development ONLY.
 * @class       acf_field_image
 * @extends     acf_field
 * @package     sirna-hotspot
 * @subpackage  acf-sirna-hotspot
 */

if( ! class_exists('acf_field_sirna_hotspot') ) :

class acf_field_sirna_hotspot extends acf_field {

    
    function __construct() {

        // vars
        $this->name = 'sirna_hotspot';
        $this->label = 'Sirna Hotspot';
        $this->category = 'Sirna';
        $this->defaults = array(
            'return_format' => 'array',
            'preview_size'  => 'full',
            'library'       => 'all'
        );

        // filters
        add_filter('get_media_item_args',           array($this, 'get_media_item_args'));
        add_filter('wp_prepare_attachment_for_js',  array($this, 'wp_prepare_attachment_for_js'), 10, 3);


        parent::__construct();
    }


    function render_field( $field ) {

        // enqueue
        acf_enqueue_uploader();


        // vars
        $div_atts = array(
            'class'                 => 'acf-image-uploader acf-cf',
            'data-preview_size'     => $field['preview_size'],
            'data-library'          => $field['library']
        );
        $input_atts = array(
            'type'                  => 'hidden',
            'name'                  => $field['name'],
            'value'                 => $field['value'],
            'data-name'             => 'value-id'
        );
        $url = '';


        // has value?
        if( $field['value'] && is_numeric($field['value']) ) {
            
            $url = wp_get_attachment_image_src($field['value'], $field['preview_size']);
            $url = $url[0];
            
            $div_atts['class'] .= ' has-value';
        }

?>
<div <?php acf_esc_attr_e( $div_atts ); ?>>
    <div class="acf-hidden">
        <input <?php acf_esc_attr_e( $input_atts ); ?>/>
    </div>
    <div class="view show-if-value acf-soh">
        <ul class="acf-hl acf-soh-target">
            <li><a class="acf-icon dark" data-name="edit-button" href="#"><i class="acf-sprite-edit"></i></a></li>
            <li><a class="acf-icon dark" data-name="remove-button" href="#"><i class="acf-sprite-delete"></i></a></li>
        </ul>
        <div class="shs-img-outer">
            <img class="shs-img" data-name="value-url" src="<?php echo $url; ?>" alt=""/>
        </div>
    </div>
    <div class="view hide-if-value">
        <p><?php 'No image selected' ?> <a data-name="add-button" class="acf-button" href="#">Choose Image</a></p>
    </div>
</div>
<?php
    }


    function render_field_settings( $field ) {

        // return_format
        acf_render_field_setting( $field, array(
            'label'         => 'Return Value',
            'instructions'  => 'Specify the returned value on front end',
            'type'          => 'radio',
            'name'          => 'return_format',
            'layout'        => 'horizontal',
            'choices'       => array(
                'array'         => 'Image Array',
                'url'           => 'Image URL',
                'id'            => 'Image ID'
            )
        ));
        
        
        // preview_size
        acf_render_field_setting( $field, array(
            'label'         => 'Preview Size',
            'instructions'  => 'Shown when entering data',
            'type'          => 'radio',
            'name'          => 'preview_size',
            'layout'        => 'horizontal',
            'choices'       => acf_get_image_sizes()
        ));
        
        
        // library
        acf_render_field_setting( $field, array(
            'label'         => 'Library',
            'instructions'  => 'Limit the media library choice',
            'type'          => 'radio',
            'name'          => 'library',
            'layout'        => 'horizontal',
            'choices'       => array(
                'all'           => 'All',
                'uploadedTo'    => 'Uploaded to post'
            )
        ));     
    }


    function format_value( $value, $post_id, $field ) {

        if ( empty( $value ) ) return $value;


        $value = intval( $value );


        // format
        if( $field['return_format'] == 'url' ) {
        
            $value = wp_get_attachment_url( $value );
            
        } elseif( $field['return_format'] == 'array' ) {
            
            $attachment = get_post( $value );

            // validate
            if( !$attachment ) return false;
            
            
            // create array to hold value data
            $src = wp_get_attachment_image_src( $attachment->ID, 'full' );
            
            $value = array(
                'ID'            => $attachment->ID,
                'alt'           => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
                'title'         => $attachment->post_title,
                'url'           => $src[0],
                'width'         => $src[1],
                'height'        => $src[2],
            );
        }
        
        return $value;
    }


    function get_media_item_args( $vars ) {

        $vars['send'] = true;
        return($vars);
    }


    function wp_prepare_attachment_for_js( $response, $attachment, $meta ) {

        // validate
        if( $response['type'] != 'image' ) return $response;
        if( !isset($meta['sizes']) ) return $response;
        
        
        $attachment_url = $response['url'];
        $base_url = str_replace( wp_basename( $attachment_url ), '', $attachment_url );
        
        if( isset($meta['sizes']) && is_array($meta['sizes']) ) {
        
            foreach( $meta['sizes'] as $k => $v ) {
            
                if( !isset($response['sizes'][ $k ]) ) {
                
                    $response['sizes'][ $k ] = array(
                        'height'      => $v['height'],
                        'width'       => $v['width'],
                        'url'         => $base_url .  $v['file'],
                        'orientation' => $v['height'] > $v['width'] ? 'portrait' : 'landscape',
                    );
                }
            }
        }

        return $response;
    }


    function update_value( $value, $post_id, $field ) {

        // array?
        if( is_array($value) && isset($value['ID']) ) {
        
            $value = $value['ID'];  
            
        }
        
        
        // object?
        if( is_object($value) && isset($value->ID) ) {
        
            $value = $value->ID;
            
        }
        
        
        // return
        return $value;
    }


    function input_admin_enqueue_scripts() {
        
        $dir = plugin_dir_url( __FILE__ );
        
        
        // register & include JS
        wp_register_script( 'acf-input-sirna_hotspot', "{$dir}script/input.js" );
        wp_enqueue_script('acf-input-sirna_hotspot', array('jquery'));
        
        
        // register & include CSS
        wp_register_style( 'acf-input-sirna_hotspot', "{$dir}style/input.css" );
        wp_enqueue_style('acf-input-sirna_hotspot');
    }
}

new acf_field_sirna_hotspot();

endif;

?>
