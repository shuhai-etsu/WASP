<!--
    Includes list of Javascript files that are common on all the pages. This file is included in the main layout
    pages. Page specific javascript files can be included into this file by using the push command in those pages themselves
-->

@push('javascript')
<!-- Add JQuery script -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- JQWidgets scripts -->
<script type="text/javascript" src="{{ URL::asset('jqwidgets/jqx-all.js') }}"></script>


<!-- javascript dependencies for bootstrap datatable -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.flash.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.html5.min.js') }}"></script>

<!--- javscript dependencies for bootstrap dashboard -->
<script type="text/javascript" src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/metisMenu.min.js') }}"></script>

<!-- Javascript dependency for bootstrap -->
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.js') }}"></script>

<!-- Sidebar -->
<script type="text/javascript" src="{{ URL::asset('js/sidebar.js') }}"></script>

<!-- Breadcrumbs -->
<script type="text/javascript" src="{{ URL::asset('js/breadcrumb.js') }}"></script>

<!-- Jquery Timepicker -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.timepicker.min.js') }}"></script>

<!-- varibales used in other javascript files -->
<script type="text/javascript" src="{{ URL::asset('js/vars.js') }}"></script>

<script>
    //initialize the base url for javascript access to the server url
    var BASE_URL =@php echo json_encode(url('/')); @endphp;
</script>

<!-- add custom js -->
{{--<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>--}}
@endpush

@stack('javascript')