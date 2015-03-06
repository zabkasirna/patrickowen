var Newsletter = {
    init: {
        selecter: initSelect
    }
};

function initSelect() {
    if ( !$( '.wysija-select' ).length ) return;

    var $el = $( '.wysija-select' );

    $el.selecter();
}

module.exports = Newsletter;