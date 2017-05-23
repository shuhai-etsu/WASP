
/**
 * JQuery code which is included in the users section in the application
 *
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    //The only difference between this JS file and table.js is the removal of 'f' in the dom for removing the datable's
    // search bar
    $('.users_table').DataTable({
        dom: "<'row col-md-12'<'pull-left'><'pull-right'l>><'row col-md-12'tr><'row col-md-12 text-center'p>",
        "order": [],
        "columnDefs": [ {
            "targets"  : 'no-sort',
            "orderable": false,
        }],
        language: {
            "emptyTable": "No users found or displayed."
       }
    });

    //Define behavior when advanced search is clicked on
    $('.advanced_search_btn').click(function () {
        $('.advanced_search').removeClass('hidden');
        $('.simple_search').addClass('hidden');
        $('.advanced_search_btn').addClass('hidden');
    });

});
