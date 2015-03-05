var Headline = {
    init: init
};

function init() {
    var headlineWay = $('.loop')
        .waypoint(
            function(direction) {

                var $el = $( this.element )
                ,   $headline = $el.next( '.headline' ).find('.title')
                ,   $prev = $el.prev( '.headline' ).find('.title')
                ,   _y  = 60;

                if ( direction === 'down' ) {

                    $headline.transition( { y: (_y * -1) } );

                    if ( $prev.length ) {

                        $prev.transition( { y: (_y * -2) } );

                    }

                }

                else {

                    $headline.transition( { y: _y } );

                    if ( $prev.length ) {

                        $prev.transition( { y: _y * -1 } );

                    }

                }

                var $parent = $el.parent();
                $parent.find('.active').removeClass('active');
                $el.addClass('active');
                $el.next('.headline').addClass('active');

            },
            {
                offset: function() {
                    return ($(window).height() / 2) + 48;
                }
            }
        );
}

module.exports = Headline;