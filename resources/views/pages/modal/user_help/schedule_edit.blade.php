<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Schedule Help
@stop
@section('help_modal_body')
    <b>Edit an existing schedule</b><br/>
    <ul>
        <li>Edit the schedule detail such as abbreviation, description, semester and classroom.</li>
        <li>Click on the<span class="btn btn-primary disabled">Save and Proceed</span> to save the changes. Click on the <span class="btn btn-primary disabled">Delete</span> to delete the scedule. <span class="btn btn-primary disabled">Cancel</span> to cancel the schedule.</li>
    </ul>
    <b>Some more information on table data</b>
    <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
    <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
@stop
@include('pages.modal.user_help.help_modal_template')