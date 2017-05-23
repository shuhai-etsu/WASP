<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Warnings Help
@stop
@section('help_modal_body')
    <ul>
        <b>Dismiss Warnings</b>
        <p>Click on Dismiss button to dismiss warning that you have reviewed.This is done in the following ways:</p>
        <li>Dismiss all warning</li>
        <p>Click the <span class="btn btn-primary disabled">Dismiss All</span>
            dismiss all the reviewed warning at once.</p>
        <li>Dismiss a warning</li>
        <p>Click the <span class="btn btn-primary disabled">Dismiss</span> to
            dismiss all the specific reviewed warning.</p>
    </ul>
    <ul>
        <b>Some more information on table data</b>
        <li>Click the drop down "Show 10 entries" to select how many rows you would like.</li>
        <li> If table has more than ten rows then you can press the "Previous", "Next", or page number's button to navigate to the respective page.</li>
    </ul>
@stop
@include('pages.modal.user_help.help_modal_template')