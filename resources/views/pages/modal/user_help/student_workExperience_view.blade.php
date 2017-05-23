<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
Work Experience Help
@stop
@section('help_modal_body')
<b>What is this?</b>
<li>Here you can view the details of your work experience in the company(ies).</li>
<b>View your work experience</b>
<li>The date you left the company(ies) and reason for leaving it is listed here.</li>
<b>Some more information on table data</b>
<li>Click the drop down "Show 10 entries" to select the number of rows you would like to view.</li>
<li>If the table have more than ten rows then you can press the "Previous", "Next", or page number to navigate the respective page.</li>
@stop
@include('pages.modal.user_help.help_modal_template')