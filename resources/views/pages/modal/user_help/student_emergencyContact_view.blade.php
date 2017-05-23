<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Emergency Contact Help
@stop
@section('help_modal_body')
    <b>What is this?</b>
    <li>Here you can view, edit and add emergency contact(s).</li>
    <b>Creating a new emergency contact</b>
    <li>Click the<span class="btn btn-primary disabled">New Emergency Contact</span>
        button to create a emergency contact.</li>
    <b>Editing an existing emergency contact</b>
    <li>Click the<span class="btn btn-primary disabled">Edit</span>
        button to edit a emergency contact.</li>
    <b>Some more information on table data</b>
    <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
    <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
@stop
@include('pages.modal.user_help.help_modal_template')