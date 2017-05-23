<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Availabilities Help
@stop
@section('help_modal_body')
    <b>What is this?</b>
    <li>Here you can list/edit what day(s) of the week and time(s) you are not available to work for a period.</li>
    <b>Creating a new availability exception</b>
    <li>Click the<span class="btn btn-primary disabled">New Availabilities Exception</span>
        button to create a new day and time you are not available to work.</li>
    <b>Edit an availability exception</b>
    <li>Click on an individual row to navigate to the edit screen. </li>
    <li>You can edit individual fields and click on the<span class="btn btn-primary disabled">Save</span> button
        to confirm the changes.</li>
    <b>Delete an availability exception</b>
    <li>Any operation can be cancelled by clicking on the<span class="btn btn-default disabled">Cancel</span> button. Cancelling an operation will take you back to the previous page.</li>
    <b>Some more information on table data</b>
    <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
    <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
@stop
@include('pages.modal.user_help.help_modal_template')