/**
 * Created by sauhardad on 2/12/17.
 * JQuery code which is included in notification page
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function(){
    //init a datatable
    var table=$('#example').DataTable(
        {
            "order": [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }],

            //"dom": "<bottom <'row'<'.col-md-4' l><'.col-md-4'i><'.col-md-4'p>>>"
            //"dom": '<"top"l>rt<"bottom"p><"clear">'
            "dom": '<"top"l>rt<"bottom"p><"clear">'
            //"dom": '<"top"l>rt<"bottom"<"pull-right"<"col-md-4"p>>><"clear">'
            //"dom": "f<'row'<'col-sm-12'tr>>" +
            //"<'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>>"



        });
    // Handle click on "Select all" control
    $('#example-select-all').on('click', function(){
        // Check/uncheck all checkboxes in the table
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
});

// Handle click on checkbox to set state of "Select all" control
$('#example tbody').on('change', 'input[type="checkbox"]', function(){
    // If checkbox is not checked
    if(!this.checked){
        var el = $('#example-select-all').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
        if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
        }
    }
});




