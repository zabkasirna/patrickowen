(function($){

    function getHotspotElements( $parent, isAlreadyExists ) {
        var $grandParent = $('.acf-field[data-name="shs_main"]')
        ,   $parentField = $parent
        ,   $shsEl = $parentField.find('.shs-img-outer')
        ,   $imageEl = $shsEl.find('img.shs-img')
        ,   $checkboxNbr = $shsEl.closest('.acf-row:not(".clone") .acf-field[data-type="sirna_hotspot"]').parent()
                .find('.acf-field[data-name="is_shs"] .acf-input li input[type="checkbox"]')
        ;

        var $returns = {
            shsEl: $shsEl,
            parentField: $parentField,
            imageEl: $imageEl,
            checkboxNbr: $checkboxNbr
        };

        return $returns;
    }

    function addHotspot( $hotspot, e ) {

        if ( !$hotspot.checkboxNbr.is( ':checked' ) ) return;
        if ( $hotspot.shsEl.find('.draggable').length ) return;

        // Append Pin
        var $pinOuter = addPin( $hotspot, e );


        // Drag Pin
        addPinDragEvent( $hotspot, $pinOuter );


        // Repeater
        addRepeater( $hotspot );

        return $pinOuter;
    }

    function addPin( $hotspot, e ) {

        var offset = $hotspot.shsEl.offset()
        ,   relX   = Math.floor( ( e.pageX - offset.left ) / $hotspot.shsEl.width() * 100 )
        ,   relY   = Math.floor( ( e.pageY - offset.top ) / $hotspot.shsEl.height() * 100 );

        var $pinOuter = $('<div class="shs-pin-outer" />')
        ,   $pinLabel = $('<p class="shs-pin-label" />');

        $pinOuter = $hotspot.shsEl.find('.draggable').length ? 
            $pinOuter :
            $pinOuter.appendTo( $hotspot.shsEl )
            .css({
                'top': relY + '%',
                'left': relX + '%'
            })

        var _pinId = $hotspot.shsEl.closest('.acf-row:not(".clone") .acf-field[data-type="sirna_hotspot"]').parent()
                .find('.acf-field[data-name="shs_data"]')
                .find('.acf-input .acf-table')
                .find('.acf-row:not(".clone")')
                .length + 1;

        $pinLabel
            .text( _pinId )
            .appendTo( $pinOuter );

        return $pinOuter;
    }

    function addExistingHotspot( $hotspot, _id, _data ) {
        if ( !$hotspot.checkboxNbr.is( ':checked' ) ) return;
        if ( $hotspot.shsEl.find('.draggable').length ) return;

        var $pinOuter = addExistingPin( $hotspot, _id, _data.x, _data.y );

        // Drag Pin
        addPinDragEvent( $hotspot, $pinOuter );

        return $pinOuter;
    }

    function addExistingPin( $hotspot, _id, _x, _y ) {

        var $pinOuter = $('<div class="shs-pin-outer" />')
        ,   $pinLabel = $('<p class="shs-pin-label" />');

        $pinOuter = $hotspot.shsEl.find('.draggable').length ? 
            $pinOuter :
            $pinOuter.appendTo( $hotspot.shsEl )
            .css({
                'top': _y + '%',
                'left': _x + '%'
            });

            $pinLabel
                .text( _id )
                .appendTo( $pinOuter );

            return $pinOuter;
    }

    function addPinDragEvent( $hotspot, $pin ) {
        var $outer = $pin.closest('.shs-img-outer');

        $pin.on( 'mousedown', function( e ) {

            $(this).addClass('draggable');

            $outer.on( 'mousemove', function( e ) {
                
                var $draggable = $( this ).find( '.draggable' )

                $draggable
                    .offset({
                        top: e.pageY - $draggable.outerHeight() / 2,
                        left: e.pageX - $draggable.outerWidth() / 2
                    })

            })
            .on( 'mouseup', function( e ) {
                e.preventDefault();
            });

            e.preventDefault();
        })
        .on( 'mouseup', function() {
            var draggableTimeout = window.setTimeout(
                function() {
                    $('.draggable').removeClass( 'draggable' );

                    var $shsDataEl = $hotspot.shsEl
                            .closest('.acf-row:not(".clone") .acf-field[data-type="sirna_hotspot"]').parent()
                            .find('.acf-field[data-name="shs_data"]');

                    updateRepeaterXY( $hotspot, $shsDataEl );

                    window.clearTimeout( draggableTimeout );
                }, 100 );
        });
    }

    function addRepeater( $hotspot ) {

        var $shsDataEl = $hotspot.shsEl.closest('.acf-row:not(".clone") .acf-field[data-type="sirna_hotspot"]').parent()
                .find('.acf-field[data-name="shs_data"]')

        ,   $addHotspotBtn = $shsDataEl
                .find('.acf-button.acf-repeater-add-row').last();

        console.log( '=6', $shsDataEl );

        // Trigger new repeater
        $addHotspotBtn.trigger('click');

        // Connect repeater xy input with related pin
        updateRepeaterXY( $hotspot );
    }

    function updateRepeaterXY( $hotspot ) {
        var $shsDataEl = $hotspot.shsEl.closest('.acf-row:not(".clone") .acf-field[data-type="sirna_hotspot"]').parent()
                .find('.acf-field[data-name="shs_data"]');

        var $shsInputX = $shsDataEl.find('.acf-row:not(".clone") .acf-field[data-name="shs_x"] input[type="number"]')
        ,   $shsInputY = $shsDataEl.find('.acf-row:not(".clone") .acf-field[data-name="shs_y"] input[type="number"]');

        $shsInputX.each( function( i ) {
            var $el = $(this), _relId = i
            ,   $pinRel = $hotspot.shsEl.find('.shs-pin-outer').eq( _relId )
            ,   _val = Math.ceil( parseInt( $pinRel.css('left').replace('px', ''), 10 ) / $hotspot.shsEl.width() * 100 );

            if ( !$el.prop('readonly') ) $el.prop('readonly');

            $el.val( _val );
        });

        $shsInputY.each( function( i ) {
            var $el = $(this), _relId = i
            ,   $pinRel = $hotspot.shsEl.find('.shs-pin-outer').eq( _relId )
            ,   _val = Math.ceil( parseInt( $pinRel.css('top').replace('px', ''), 10 ) / $hotspot.shsEl.height() * 100 );

            if ( !$el.prop('readonly') ) $el.prop('readonly');

            $el.val( _val );
        });
    }

    function checkExistence( $el ) {
        var test = $el.parent()
            .find('.acf-field[data-name="shs_data"]')
            .find('.acf-row:not(".clone")')
            .find('.acf-field[data-name="shs_x"]')
            .find('input[type="number"]')
            ;

        return test.length > 0;
    }

    function getExistingRepeaters( $el ) {

        var _data = []
        ,   $shsDataEl = $el.parent()
                .find('.acf-field[data-name="shs_data"]')
                .find('.acf-row:not(".clone")');

        $shsDataEl.each( function( i ) {
            var _x = parseInt( $(this).find('.acf-field[data-name="shs_x"] input[type="number"]').val(), 10 )
            ,   _y = parseInt( $(this).find('.acf-field[data-name="shs_y"] input[type="number"]').val(), 10 );

            _data.push( { x: _x, y: _y } );
        });

        return _data;
    }

    function initHotspotRemovers( $hotspot ) {
        var $removers = $('.acf-field[data-name="shs_data"] .acf-row:not(".clone") .acf-repeater-remove-row');

        // console.log( $removers );

        $removers.each( function() {

            var $el = $(this);

            $el.on( 'click', function(e) {

                var $row_a = $el.closest( '.acf-row' )
                ,   $row_a_field = $row_a.closest( '.acf-field[data-name="shs_data"]' )
                ,   $row_b = $row_a_field.closest( '.acf-row' )
                ,   $row_b_field = $row_b.closest( '.acf-field[data-name="shs_main"]' );

                var row_a_id = $row_a_field.find( $row_a ).index()
                ,   row_b_id = $row_b_field.find( $row_b ).index()

                $('.acf-field[data-type="sirna_hotspot"]').eq( row_b_id )
                    .find('.shs-pin-outer').remove();

                function updateHotspot() {
                    var $freshParent = $row_b.last().find( '.acf-field[data-type="sirna_hotspot"]' );

                    var existingData = getExistingRepeaters( $freshParent );

                    for ( var i = 0; i < existingData.length; i ++ ) {
                        addExistingHotspot( $hotspot, (i + 1), existingData[i] );
                    }
                }

                setTimeout( updateHotspot, 1000 );
            })

        });

    }

    acf.add_action( 'ready append', function( $el ) {

        acf.get_fields({ type: 'sirna_hotspot' }, $el)
            .each(
                function() {
                    console.clear();

                    var isAlreadyExists = checkExistence( $(this) );

                    var $hotspot = getHotspotElements( $(this), isAlreadyExists )
                    ,   hotspotLists = []
                    ,   existingData;

                    if ( isAlreadyExists ) {
                        existingData = getExistingRepeaters( $(this) );

                        console.log( $(this)[0] );

                        for ( var i = 0; i < existingData.length; i ++ ) {
                            addExistingHotspot( $hotspot, (i + 1), existingData[i] );
                        }
                    }

                    $hotspot.shsEl.on('click', function( e ) {

                        e.preventDefault();
                        addHotspot( $hotspot, e );
                    });


                    initHotspotRemovers( $hotspot );

                }
            );
    });


})(jQuery);
