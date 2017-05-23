/**
 * Created by noama on 3/23/16.
 * JQuery code which is included in report pages
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function(){
    var table;
    //init datatable if one has not been iniitalized already
    if ( $.fn.dataTable.isDataTable( '.template-table' ) ) {
        table = $('.template-table').DataTable();
        table.destroy();
        table=$('.template-table').DataTable({
            dom: "<'row col-md-12'<'pull-left'f><'pull-right'l>><'row col-md-12'tr><'row col-md-12 text-center'p><'pull-right'B>",
            buttons: {
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]
            },
            "order": [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }]
        });
    }
});

/*
*/
/*{extend: 'copy', className: 'btn-primary'},
 {extend: 'csv', className: 'btn-primary'},
 {extend: 'excel', className: 'btn-primary'},
 {extend: 'pdf', className: 'btn-primary'},
 {extend: 'print', className: 'btn-primary'}*/