// Show/hide a div
jQuery.fn.showHideDiv = function() {
    var o = $(this[0]) // It's your element
    var args = arguments[0] || {}; // It's your object of arguments
        
    if (args.is(":hidden")) {
        //args.show(200);
        args.slideDown();
    } else {
        //args.hide(500);
        args.slideUp();
    }
        
    if (o.attr('class').indexOf("fa fa-plus-square-o") != -1 ) {
        o.removeClass( "fa fa-plus-square-o pointer" )
        o.addClass( "fa fa-minus-square-o pointer" );
    } else {
        o.removeClass( "fa fa-minus-square-o pointer" )
        o.addClass( "fa fa-plus-square-o pointer" );
    }
            
    return false;
}; 