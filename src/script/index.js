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

    // Product Archive
    // -- Heirloom
    Product.init.archive.heirloom();

    // Product Single
    // Heirloom
    Product.init.single.heirloom();
    Product.init.hotspot();
});
