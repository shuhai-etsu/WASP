<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Schedule Help
@stop
@section('help_modal_body')
    <b>Create a new schedule</b><br/>
    <ul>
        <li>Click on the<span class="btn btn-primary disabled">New Schedule</span> button to create a new schedule.</li>
    </ul>
    <b>Some more information on table data</b>
    <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
    <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
@stop
@include('pages.modal.user_help.help_modal_template')