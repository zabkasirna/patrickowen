var Headline = require('./Headline')
,   Navigation = require('./Navigation')
,   Product = require('./Product')
;

$(window).on('load', function() {
    // Headline
    setTimeout( Headline.init, 100 );

    // Navigation
    Navigation.init.submenu();

    // Product
    Product.init.quantity.stepper();

});