<?php

class acf_field_sirna_hotspot extends acf_field {
    
    // vars
    var $settings, // will hold info such as dir / path
        $defaults; // will hold default field options

    /*
    *  __construct
    *
    *  Set name / label needed for actions / filters
    *
    *  @since   0.0.1
    *  @date    09/03/15
    */
    
    function __construct()
    {
        // vars
        $this->name = 'sirna_hotspot';
        $this->label = __('Sirna Hotspot');
        $this->category = __("Content",'acf'); // Basic, Content, Choice, etc
        $this->defaults = array(
            'save_format'   =>  'url',
            'preview_size' => 'full',
            'library'       =>  'all'
        );
        
        
        // do not delete!
        parent::__construct();
        
        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '0.0.1'
        );

    }
    
    
    /*
    *  create_options()
    *
    *  Create extra options for field. Rendered when editing a field.
    *  The value of $field['name'] can be used (like below) to save extra data to the $field
    *
    *  @type    action
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   $field  - an array holding all the field's data
    */
    
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

</tr>
        <?php
        
    }
    
    
    /*
    *  create_field()
    *
    *  Create the field HTML interface
    *
    *  @param   $field - an array holding all the field's data
    *
    *  @type    action
    *  @since   0.0.1
    *  @date    09/03/15
    */
    
    function create_field( $field )
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */
        
        // perhaps use $field['preview_size'] to alter the markup?
        
        
        // create Field HTML
        ?>
        <div>
            
        </div>
        <?php
    }
    
    
    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where the field is created.
    *  Use this action to add CSS + JavaScript to assist create_field() action.
    *
    *  $info    http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type    action
    *  @since   0.0.1
    *  @date    09/03/15
    */

    function input_admin_enqueue_scripts()
    {
        // register ACF scripts
        wp_register_script( 'acf-input-sirna_hotspot', $this->settings['dir'] . 'script/input.js', array('acf-input'), $this->settings['version'] );
        wp_register_style( 'acf-input-sirna_hotspot', $this->settings['dir'] . 'style/input.css', array('acf-input'), $this->settings['version'] ); 

        // scripts
        wp_enqueue_script(array(
            'acf-input-sirna_hotspot'
        ));

        // styles
        wp_enqueue_style(array(
            'acf-input-sirna_hotspot'
        ));
    }
    
    
    /*
    *  input_admin_head()
    *
    *  This action is called in the admin_head action on the edit screen where the field is created.
    *  Use this action to add CSS and JavaScript to assist the create_field() action.
    *
    *  @info    http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
    *  @type    action
    *  @since   0.0.1
    *  @date    09/03/15
    */

    function input_admin_head()
    {
        // Note: This function can be removed if not used
    }
    
    
    /*
    *  field_group_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where the field is edited.
    *  Use this action to add CSS + JavaScript to assist the create_field_options() action.
    *
    *  $info    http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type    action
    *  @since   0.0.1
    *  @date    09/03/15
    */

    function field_group_admin_enqueue_scripts()
    {
        // Note: This function can be removed if not used
    }

    
    /*
    *  field_group_admin_head()
    *
    *  This action is called in the admin_head action on the edit screen where the field is edited.
    *  Use this action to add CSS and JavaScript to assist the create_field_options() action.
    *
    *  @info    http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
    *  @type    action
    *  @since   0.0.1
    *  @date    09/03/15
    */

    function field_group_admin_head()
    {
        // Note: This function can be removed if not used
    }


    /*
    *  load_value()
    *
        *  This filter is applied to the $value after it is loaded from the db
    *
    *  @type    filter
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   $value - the value found in the database
    *  @param   $post_id - the $post_id from which the value was loaded
    *  @param   $field - the field array holding all the field options
    *
    *  @return  $value - the value to be saved in the database
    */
    
    function load_value( $value, $post_id, $field )
    {
        return $value;
    }
    
    
    /*
    *  update_value()
    *
    *  This filter is applied to the $value before it is updated in the db
    *
    *  @type    filter
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   $value - the value which will be saved in the database
    *  @param   $post_id - the $post_id of which the value will be saved
    *  @param   $field - the field array holding all the field options
    *
    *  @return  $value - the modified value
    */
    
    function update_value( $value, $post_id, $field )
    {
        return $value;
    }
    
    
    /*
    *  format_value()
    *
    *  This filter is applied to the $value after it is loaded from the db and before it is passed to the create_field action
    *
    *  @type    filter
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   $value  - the value which was loaded from the database
    *  @param   $post_id - the $post_id from which the value was loaded
    *  @param   $field  - the field array holding all the field options
    *
    *  @return  $value  - the modified value
    */
    
    function format_value( $value, $post_id, $field )
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */
        
        // perhaps use $field['preview_size'] to alter the $value?
        
        return $value;
    }
    
    
    /*
    *  format_value_for_api()
    *
    *  This filter is applied to the $value after it is loaded from the db and before it is passed back to the API functions such as the_field
    *
    *  @type    filter
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   $value  - the value which was loaded from the database
    *  @param   $post_id - the $post_id from which the value was loaded
    *  @param   $field  - the field array holding all the field options
    *
    *  @return  $value  - the modified value
    */
    
    function format_value_for_api( $value, $post_id, $field )
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */
        
        // perhaps use $field['preview_size'] to alter the $value?

        return $value;
    }
    
    
    /*
    *  load_field()
    *
    *  This filter is applied to the $field after it is loaded from the database
    *
    *  @type    filter
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   $field - the field array holding all the field options
    *
    *  @return  $field - the field array holding all the field options
    */
    
    function load_field( $field )
    {
        return $field;
    }
    
    
    /*
    *  update_field()
    *
    *  This filter is applied to the $field before it is saved to the database
    *
    *  @type    filter
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   $field - the field array holding all the field options
    *  @param   $post_id - the field group ID (post_type = acf)
    *
    *  @return  $field - the modified field
    */

    function update_field( $field, $post_id )
    {
        return $field;
    }

    
}


// create field
new acf_field_sirna_hotspot();

?>
