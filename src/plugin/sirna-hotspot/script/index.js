(function($){

    function init() {

        var $imageOuter = $('.acf-row:not(".clone")').last().find('.shs-img-outer')
        ,   $parentField = $imageOuter.closest('.field_type-sirna_hotspot')
        ;

        console.clear();
        console.log( $imageOuter );
        console.log( $parentField );

    }

    acf.add_action( 'ready append', function( $el ) {
        
        acf.get_fields({ type: 'sirna_hotspot' }, $el)
            .each(
                function() {
                    
                    init();
                }
            );
    });


})(jQuery);
