<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Systems Help
@stop
@section('help_modal_body')
    <b>Add a new item</b><br/>
    <ul>
        <li>Click on the<span class="btn btn-primary disabled">New</span> button to navigate to the add new item screen.</li>
    </ul>
    <b>Edit an existing item</b>
    <ul>
        <li>Click on an individual row to navigate to the edit screen. </li>
        <li>You can edit individual fields and click on the<span class="btn btn-primary disabled">Save</span> button
            to confirm the changes.</li>
    </ul>
    <b>Delete an item</b>
    <ul>
        <li>Any operation can be cancelled by clicking on the<span class="btn btn-default disabled">Cancel</span> button. Cancelling an operation will take you back to the previous page.</li>
    </ul>
@stop
@include('pages.modal.user_help.help_modal_template')