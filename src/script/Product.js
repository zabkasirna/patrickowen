var Product = {
    init: {
        quantity: {
            stepper: initQuantityStepper
        },
        variant: {
            selecter: initVariantSelecter
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

module.exports = Product;