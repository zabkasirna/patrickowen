var Headline = require('./Headline')
,   Navigation = require('./Navigation')
,   Product = require('./Product')
,   Newsletter = require('./Newsletter')
;

$(window).on('load', function() {
    // Headline
    setTimeout( Headline.init, 100 );

    // Navigation
    Navigation.init.submenu();

    // Product
    Product.init.quantity.stepper();
    Product.init.variant.selecter();

    //Newsletter
    Newsletter.init.selecter();

    // Heirloom
    var _hpcCounter = 1;
    $('.hpc-next').on('click', function( e ) {
        e.preventDefault;

        var parentH = $('.heirloom-product').height()
        ,   $item = $('.heirloom-product-item');

        if ( _hpcCounter < $item.length ) {
            $item.each( function( i ) {
                $(this).transition({
                        y: '-=' + parentH
                    });
                });
            _hpcCounter ++;
        }
    });
    $('.hpc-prev').on('click', function( e ) {
        e.preventDefault;

        var parentH = $('.heirloom-product').height()
        ,   $item = $('.heirloom-product-item');

        if ( _hpcCounter > 1 ) {
            $item.each( function( i ) {
                $(this).transition({
                        y: '+=' + parentH
                    });
                });
            _hpcCounter --;
        }
    });
    $('.heirloom-product-item').each( function() { $(this).zoom({
        on: 'click'
    }); });
    $('.hpc-zoom').on( 'click', function() {
        console.log( $('.heirloom-product-item').eq( _hpcCounter ) );
        $('.heirloom-product-item').eq( _hpcCounter - 1 ).trigger( 'click' );
    });

    // Product Archive
    // -- Heirloom
    Product.init.archive.heirloom();

});
