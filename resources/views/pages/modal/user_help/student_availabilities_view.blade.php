<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Availabilities Help
@stop
@section('help_modal_body')
    <b>What is this?</b>
        <li>Here you can add and view what day(s) of the week and time(s) you are available to work for a semester.</li>
    <b>Creating a new availability</b>
        <li>Click the<span class="btn btn-primary disabled">New Availabilities</span>
            button to create a new day and time you are available to work.</li>
    <b>Some more information on table data</b>
        <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
        <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
@stop
@include('pages.modal.user_help.help_modal_template')