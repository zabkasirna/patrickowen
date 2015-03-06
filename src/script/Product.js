var Product = {
    init: {
        quantity: {
            stepper: initQuantityStepper
        }
    }
};

function initQuantityStepper() {
    if ( !$('.product').length ) return;

    var $product = $( '.product' )
    ,   $quantity = $product.find('.quantity > input[type="number"]');

    $quantity.each( function( i ) {
        $(this).stepper();
    });
}

module.exports = Product;