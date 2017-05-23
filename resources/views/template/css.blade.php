<!--
    Includes list of Javascript files that are common on all the pages. This file is included in the main layout
    pages. Page specific javascript files can be included into this file by using the push command in those pages themselves
-->

@push('css')
<!-- add the css files -->

    <!-- bootstrap and custom css respectively -->
    <link href="{{ URL::asset('css/base_bootstrap.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/base_layout.css') }}" media="screen" rel="stylesheet" type="text/css">

    <!-- bootstrap datatable css -->
    <link href="{{ URL::asset('css/dataTables.bootstrap.min.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/buttons.dataTables.min.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/buttons.dataTables.css') }}" media="screen" rel="stylesheet" type="text/css">

    <!-- add one of the jQWidgets styles -->
    <link rel="stylesheet" href="{{ URL::asset('jqwidgets/styles/jqx.base.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('jqwidgets/styles/jqx.darkblue.css') }}" type="text/css" />
    <meta name="description" content="jqxChart - JavaScript Chart Pie Series with Legend." />


    <!-- Bootstrap dashboard css -->
    <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/metisMenu.min.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" media="screen" rel="stylesheet" type="text/css">

    <!-- Jquery Timepicker-->
    <link href="{{ URL::asset('css/jquery.timepicker.css') }}" media="screen" rel="stylesheet" type="text/css">

    <!--Custom css for the page -->
    <link href="{{ URL::asset('css/custom.css') }}" media="screen" rel="stylesheet" type="text/css">
@endpush


@stack('css')
