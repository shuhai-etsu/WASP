<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    User Search Help
@stop
@section('help_modal_body')
    <ul>
        <b>Search Users</b>
        <p>Click the <span id="simple_search" class="btn btn-primary disabled">Dismiss</span> button to search for a user's first or last name.</p>
        <li>Advanced Search</li>
        <p>TBA</p>
        <li>Sort</li>
        <p>Click on a column to change the order in which the table is sorted.</p>
    </ul>
    <ul>
        <b>Some more information on table data</b>
        <li>Click the drop down "Show 10 entries" to select how many rows you would like.</li>
        <li> If table has more than ten rows then you can press the "Previous", "Next", or page number's button to navigate to the respective page.</li>
    </ul>
@stop

@include('pages.modal.user_help.help_modal_template')