<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Notifications Help
@stop
@section('help_modal_body')
    <ul>
        <b>Dismiss Notifications</b>
        <p>Click the <span class="btn btn-primary disabled">Dismiss</span> button to dismiss notifications that you have reviewed.This is done in the following ways:</p>
        <li>Dismiss all notifications</li>
        <p>Click the <span class="btn btn-primary disabled">Dismiss All</span>
            button to dismiss all the reviewed notifications at once.</p>
        <li>Dismiss a single notification</li>
        <p>Click the <span class="btn btn-primary disabled">Dismiss</span>
            button to dismiss any specific reviewed notification.</p>
    </ul>
    <ul>
        <b>Some more information on table data</b>
        <li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
        <li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
    </ul>
@stop
@include('pages.modal.user_help.help_modal_template')