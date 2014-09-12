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

    if (o.attr('class').indexOf("fa fa-plus-square-o") != -1) {
        o.removeClass("fa fa-plus-square-o pointer")
        o.addClass("fa fa-minus-square-o pointer");
    } else {
        o.removeClass("fa fa-minus-square-o pointer")
        o.addClass("fa fa-plus-square-o pointer");
    }

    return false;
};

jQuery(document).ready(function() {
    $("[rel=tooltip]").tooltip();
    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker();
    $('#table_list_job').dataTable({
        "paging": false,
        "info": false,
        "searching": false,
        "aoColumnDefs" : [{"sType":"file-size","aTargets":[9]}],
        columnDefs: [
            {type: 'file-size', targets: 9}
        ]
    });
    
    $('.table_list_pool').dataTable({
        "paging": false,
        "info": false,
        "searching": false,
        "aoColumnDefs" : [{"sType":"file-size","aTargets":[4]}],
    });    
     
    $('#table_list').dataTable({
        "paging": false,
        "info": false,
        "searching": false,        
    });     
});  