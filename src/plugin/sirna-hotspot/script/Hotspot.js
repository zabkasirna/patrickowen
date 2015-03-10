var Hotspot = {
    init: init,
    getParent: getParent
};

function init( acfEvent, parentStr ) {
    return this.getParent( parentStr );
}

function getParent( acfEvent, str ) {
    var $parent;

    if ( !$( acfEvent ).find( str ).length ) return $();

    $( acfEvent ).find( str ).each( function(){
         $parent = $(this).find( '.shs-image' );
    });

    return $parent;
}

module.exports = Hotspot;