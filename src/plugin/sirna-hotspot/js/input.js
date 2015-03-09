(function($){
    
    
    function initialize_field( $el ) {

        console.log( $el );
    }
    
    
    /*
    *  acf/setup_fields (ACF4)
    *
    *  This event is triggered when ACF adds any new elements to the DOM. 
    *
    *  @type    function
    *  @since   0.0.1
    *  @date    09/03/15
    *
    *  @param   event       e: an event object. This can be ignored
    *  @param   Element     postbox: An element which contains the new HTML
    *
    *  @return  n/a
    */
    
    $(document).on('acf/setup_fields', function(e, postbox){
        
        $(postbox).find('.field[data-field_type="sirna_hotspot"]').each(function(){

            initialize_field( $(this) );
        });
    });


})(jQuery);
