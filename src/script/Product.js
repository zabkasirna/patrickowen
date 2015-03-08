var Product = {
    init: {
        quantity: {
            stepper: initQuantityStepper
        },
        variant: {
            selecter: initVariantSelecter
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

function initHeirloomArchive() {

    if ( !$('.products-heirloom-outer').length ) return;

    var $parent  = $('.products-heirloom-outer .products')
    ,   $product = $parent.find('.product')
    ,   _parentW = $product.length * $product.width() + 'px';

    $parent.css( 'width', _parentW );

}

module.exports = Product;
