/**
 * JQuery code which is included in most admin and student pages for rendering a datatable
 * This is a way of standardizing a  template across the application
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.template-table').DataTable({
       dom: "<'row col-md-12'<'pull-left'f><'pull-right'l>><'row col-md-12'tr><'row col-md-12 text-center'p>",
        "order": [],
        "columnDefs": [ {
            "targets"  : 'no-sort',
            "orderable": false,
        }]
    });
});
