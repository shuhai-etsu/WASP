<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Applications Help
@stop
@section('help_modal_body')
    <b>View Applications</b>
    <ul>
        <li>Click the <span class="btn btn-primary disabled">View</span> button
            to view an application.</li>
    </ul>
    <b> Some more information on interacting with tables.</b>
    <ul>
        <li>Click the drop down "Show 10 entries" to select how many rows you would like.</li>
        <li> If table has more than ten rows then you can press the "Previous", "Next", or page number's button to navigate to the respective page.</li>
    </ul>
@stop
@include('pages.modal.user_help.help_modal_template')