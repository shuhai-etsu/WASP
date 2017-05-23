<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Financial Aid Recipient Report Criteria Help
@stop
@section('help_modal_body')
    <b>The table lists the following items: First Name, Last Name and FIanncial Aid.</b>
    <br/>
    <b> Some more information on interacting with tables.</b>
    <ul>
        <li>Click the drop down "Show 10 entries" to select how many rows you would like.</li>
        <li> If table has more than ten rows then you can press the "Previous", "Next", or page number's button to navigate to the respective page.</li>
        <li>Click on the provided options; they are Copy, CSV, Excel, PDF, Print to export report.</li>
    </ul>
@stop
@include('pages.modal.user_help.help_modal_template')