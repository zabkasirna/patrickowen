var Navigation = {
    init: {
        submenu: initSubmenu
    }
};

function initSubmenu() {

    // .current-menu-parent.menu-item-has-children

    var $container = $('.menu-main-navigation-container')
    ,   $toggler = $container.find('.menu-item-has-children > a')
    ,   $item;

    // console.log( $toggler[0] );
    // console.log( $item[0] );

    // Toggle submenu
    $toggler.each( function( i ) {
        $(this).on( 'click', function(e) {
            e.preventDefault();

            $item = $(this).parent('.menu-item');
            $item.toggleClass('open');
        });
    });
}

module.exports = Navigation;