var Product = {
    init: {
        quantity: {
            stepper: initQuantityStepper
        },
        variant: {
            selecter: initVariantSelecter
        },
        single: {
            heirloom: initFeatureImage
        },
        archive: {
            heirloom: initHeirloomArchive
        }
    }
};

function initQuantityStepper() {
    if ( !$('.product .cart').length ) return;

    var $product = $( '.product .cart' )
    ,   $quantity = $product.find('.quantity > input[type="number"]');

    $quantity.each( function( i ) {
        $(this).stepper();
    });
}

function initVariantSelecter() {
    if ( !$('.product .cart').length ) return;

    var $product = $( '.product .cart' )
    ,   $variant = $product.find('.variations select');

    if ( !$variant.length ) return;

    $variant.each( function( i ) {
        $(this).selecter();
    });
}

function initFeatureImage() {
    var _hpcCounter = 1
    ,   _isHpZoom = false;

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
    $('.hpc-zoom').on( 'click', function() {
        var $el = $('.heirloom-product-item').eq( _hpcCounter - 1 )
        ,   $icon = $(this).find('.fa');

        if ( !_isHpZoom ) {
            $el.zoom({
                onZoomIn: function() { _isHpZoom = true; }
            });

            $icon.attr( 'class', 'fa fa-search-minus' );
        }
        else {
            _isHpZoom = false;
            $el.trigger('zoom.destroy');
            $icon.attr( 'class', 'fa fa-search-plus' );
        }
    });
}

function initHeirloomArchive() {

    if ( !$('.products-heirloom-outer').length ) return;

    var $parent  = $('.products-heirloom-outer .products')
    ,   $product = $parent.find('.product')
    ,   _parentW = $product.length * $product.width() + 'px';

    $parent.css( 'width', _parentW );
}

module.exports = Product;
