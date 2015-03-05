var Headline = require('./Headline')
,   Navigation = require('./Navigation');

$(window).on('load', function() {
    // Headline
    setTimeout( Headline.init, 100 );

    // Navigation
    Navigation.init.submenu();

});