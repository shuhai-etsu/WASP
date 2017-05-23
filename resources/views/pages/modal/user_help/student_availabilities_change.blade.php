<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Availabilities Help
@stop
@section('help_modal_body')
    <b>What is this?</b>
    <li>Here you can request to change the exception(s) in your availabilities.</li>
    <b>Select an exception</b>
    <li>Click one or more <input type="checkbox" disabled> checkbox to select the exception(s) you want to remove.</li>
    <b>Remove an exception</b>
    <li>You can now remove the exception(s) in your availabilities by clicking on the<span class="btn btn-primary disabled">Remove Exception</span> button.</li>
    <b>Some more information on table data</b>
    <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
    <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
@stop
@include('pages.modal.user_help.help_modal_template')