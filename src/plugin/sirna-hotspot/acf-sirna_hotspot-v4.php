<?php

class acf_field_sirna_hotspot extends acf_field {
    
    // vars
    var $settings; // will hold info such as dir / path
    
    function __construct()
    {
        // vars
        $this->name = 'sirna_hotspot';
        $this->label = 'Sirna Hotspot';
        $this->category = 'Sirna'; // Basic, Content, Choice, etc
        $this->defaults = array(
            'save_format' =>  'object',
            'preview_size' => 'full',
            'library' =>  'all'
        );
        
        // do not delete!
        parent::__construct();
        
        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '0.0.1'
        );

        // filters
        add_filter('get_media_item_args', array($this, 'get_media_item_args'));
        add_filter('wp_prepare_attachment_for_js', array($this, 'wp_prepare_attachment_for_js'), 10, 3);

        // JSON
        add_action('wp_ajax_acf/fields/image/get_images', array($this, 'ajax_get_images'), 10, 1);
        add_action('wp_ajax_nopriv_acf/fields/image/get_images', array($this, 'ajax_get_images'), 10, 1);

        // Hotspot
        add_action('wp_ajax_test_response', array($this, 'ajax_test_request'), 10, 5);
    }

    function create_field( $field )
    {
        // vars
        $o = array(
            'class'     =>  '',
            'url'       =>  '',
        );
        
        if( $field['value'] && is_numeric($field['value']) )
        {
            $url = wp_get_attachment_image_src($field['value'], $field['preview_size']);
            $o['class'] = 'active';
            $o['url'] = $url[0];
        }

        printrr( $field );
        printrr( $_POST['acf'] )

        ?>
<div class="acf-image-uploader clearfix <?php echo $o['class']; ?>"
    data-preview_size="<?php echo $field['preview_size']; ?>"
    data-library="<?php echo $field['library']; ?>" >

    <input class="acf-image-value"
        type="hidden"
        name="<?php echo $field['name']; ?>"
        value="<?php echo $field['value']; ?>" />

    <div class="has-image">
        <div class="hover">
            <ul class="bl">
                <li><a class="acf-button-delete ir" href="#">Remove</a></li>
                <li><a class="acf-button-edit ir" href="#">Edit</a></li>
            </ul>
        </div>

        <div class="shs-image">
            <img class="acf-image-image" src="<?php echo $o['url']; ?>" alt=""/>
        </div>

    </div>
    <div class="no-image">
        <p>No image selected <input type="button" class="button add-image" value="Add Image" />
    </div>
</div>
        <?php

    }


    function create_options( $field )
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */
        
        // key is needed in the field names to correctly save the data
        $key = $field['name'];
        
        
        // Create Field Options HTML
        ?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
    <td class="label">
        <label>Return Value</label>
        <p>Specify the returned value on front end</p>
    </td>
    <td>
        <?php
        do_action('acf/create_field', array(
            'type'      =>  'radio',
            'name'      =>  'fields['.$key.'][save_format]',
            'value'     =>  $field['save_format'],
            'layout'    =>  'horizontal',
            'choices'   => array(
                'object'    =>  'Image Object',
                'url'       =>  'Image URL',
                'id'        =>  'Image ID'
            )
        ));
        ?>
    </td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
    <td class="label">
        <label>Preview Size</label>
        <p>Shown when entering data</p>
    </td>
    <td>
        <?php
        
        do_action('acf/create_field', array(
            'type'      =>  'radio',
            'name'      =>  'fields['.$key.'][preview_size]',
            'value'     =>  $field['preview_size'],
            'layout'    =>  'horizontal',
            'choices'   =>  apply_filters('acf/get_image_sizes', array())
        ));

        ?>
    </td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
    <td class="label">
        <label>Library</label>
        <p>Limit the media library choice</p>
    </td>
    <td>
        <?php
        
        do_action('acf/create_field', array(
            'type'      =>  'radio',
            'name'      =>  'fields['.$key.'][library]',
            'value'     =>  $field['library'],
            'layout'    =>  'horizontal',
            'choices'   =>  array(
                'all' => 'All',
                'uploadedTo' => 'Uploaded to post'
            )
        ));

        ?>
    </td>
</tr>
        <?php
    }


    function update_field( $value, $post_id, $field ) {
        printrr( $field );
        die;

        return $field;
    }

    function update_value( $value, $post_id, $field )
    {

        if( is_array($value) && isset($value['id']) )
        {
            $value = $value['id'];
        }

        if( is_object($value) && isset($value->ID) )
        {
            $value = $value->ID;
        }

        return $value;
    }


    function format_value_for_api( $value, $post_id, $field )
    {
        // validate
        if( !$value ) { return false; }
        
        // format
        if( $field['save_format'] == 'url' )
        {
            $value = wp_get_attachment_url( $value );
        }
        elseif( $field['save_format'] == 'object' )
        {
            $attachment = get_post( $value );
            
            // validate
            if( !$attachment ) { return false; }
            
            // create array to hold value data
            $src = wp_get_attachment_image_src( $attachment->ID, 'full' );
            
            $value = array(
                'id' => $attachment->ID,
                'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
                'title' => $attachment->post_title,
                'mime_type' => $attachment->post_mime_type,
                'url' => $src[0],
                'width' => $src[1],
                'height' => $src[2],
                'new_val' => get_post($post_id)
            );
        }
        
        return $value;
    }

    function get_media_item_args( $vars )
    {
        $vars['send'] = true;
        return($vars);
    }


    function ajax_get_images()
    {
        // vars
        $options = array(
            'nonce' => '',
            'images' => array(),
            'preview_size' => 'full'
        );

        $return = array();
        
        // load post options
        $options = array_merge($options, $_POST);

        // verify nonce
        if( ! wp_verify_nonce($options['nonce'], 'acf_nonce') )
        {
            die(0);
        }
        
        if( $options['images'] )
        {
            foreach( $options['images'] as $id )
            {
                $url = wp_get_attachment_image_src( $id, $options['preview_size'] );
                
                $return[] = array(
                    'id' => $id,
                    'url' => $url[0],
                );
            }
        }
        
        // return json
        echo json_encode( $return );
        die;
    }

    function image_size_names_choose( $sizes )
    {
        global $_wp_additional_image_sizes;
            
        if( $_wp_additional_image_sizes )
        {
            foreach( $_wp_additional_image_sizes as $k => $v )
            {
                $title = $k;
                $title = str_replace('-', ' ', $title);
                $title = str_replace('_', ' ', $title);
                $title = ucwords( $title );
                
                $sizes[ $k ] = $title;
            }
        }
        
        return $sizes;
    }

    function wp_prepare_attachment_for_js( $response, $attachment, $meta )
    {
        // only for image
        if( $response['type'] != 'image' )
        {
            return $response;
        }
        
        // make sure sizes exist. Perhaps they dont?
        if( !isset($meta['sizes']) )
        {
            return $response;
        }
        
        
        $attachment_url = $response['url'];
        $base_url = str_replace( wp_basename( $attachment_url ), '', $attachment_url );
        
        if( isset($meta['sizes']) && is_array($meta['sizes']) )
        {
            foreach( $meta['sizes'] as $k => $v )
            {
                if( !isset($response['sizes'][ $k ]) )
                {
                    $response['sizes'][ $k ] = array(
                        'height'      =>  $v['height'],
                        'width'       =>  $v['width'],
                        'url'         => $base_url .  $v['file'],
                        'orientation' => $v['height'] > $v['width'] ? 'portrait' : 'landscape',
                    );
                }
            }
        }

        return $response;
    }

    function input_admin_enqueue_scripts()
    {
        // register ACF scripts
        wp_register_script( 'shs_script', $this->settings['dir'] . 'script/input.js', array('acf-input'), $this->settings['version'] );
        wp_register_style( 'shs_style', $this->settings['dir'] . 'style/input.css', array('acf-input'), $this->settings['version'] ); 

        // load the script
        wp_enqueue_script(array(
            'shs_script'
        ));

        wp_localize_script(
            'shs_script',
            'the_ajax_script',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' )
            )
        );

        // styles
        wp_enqueue_style(array(
            'shs_style'
        ));
    }

    function ajax_test_request() {
        if ( isset( $_POST['post_var'] ) ) {
            $response = $_POST['post_var'];
            echo $response;
            die();
        }
    }
}


// create field
new acf_field_sirna_hotspot();

?>
