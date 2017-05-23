<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Schedule Help
@stop
@section('help_modal_body')
    <b>Enter the following items to create the schedule:</b>
    <ul>
    <li>Abbreviation:Add abbreviation for new schedule</li>
    <li>Description: Add description for new schedule.</li>
    <li>Semester: Select semester</li>
    <li>Classroom: Select classroom</li>
    <b>Some more information on table data</b>
    <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
    <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
    </ul>
@stop
@include('pages.modal.user_help.help_modal_template')