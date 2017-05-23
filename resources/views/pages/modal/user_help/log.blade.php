<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Log Help
@stop
@section('help_modal_body')
    <ul>
        <b>What is this page?</b>
        <li><p>This page displays activity on the system such as what a user has changed.</p></li>
    </ul>
    <ul>
        <b>Some more information on table data</b>
        <li>Click the drop down "Show 10 entries" to select how many rows you would like.</li>
        <li> If table has more than ten rows then you can press the "Previous", "Next", or page number's button to navigate to the respective page.</li>
    </ul>
@stop
@include('pages.modal.user_help.help_modal_template')