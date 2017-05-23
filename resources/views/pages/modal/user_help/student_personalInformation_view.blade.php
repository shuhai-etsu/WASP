<!--
    Inserts information into help modal template's respective section(s)
-->
@section('help_modal_title')
    Personal Information Help
@stop
@section('help_modal_body')
    <b>What is this?</b>
    <li>Here you can view your personal information and edit them if required.</li>
    <b>Editing personal information</b>
    <li>Click the<span class="btn btn-primary disabled">Edit</span>
        button to edit your personal information.</li>
@stop
@include('pages.modal.user_help.help_modal_template')