@extends('layouts.wasp')

@section('javascript')
    <script type="text/javascript" src="/jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxgrid.columnsresize.js"></script>
    <script type="text/javascript" src="/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            {{--
            The following values (click, lastClick and lastRow) are used to capture double click events in the grid.
            See grid code listed below for additional information.
            --}}
            var click = new Date();
            var lastClick = new Date();
            var lastRow = -1;

            {{--
            DEVELOPER NOTE: Prior to Laravel 5, HTML entities (such as quotes ("")), displayed using curly braces
            (e.g. {{}}) in blade templates WERE NOT automatically filtered. However, Laravel 5 changed the default
            behavior of curly braces to AUTOMATICALLY filter HTML entities. Therefore opening and closing quotes
            are replaced with "&quot;" variables in Laravel versions 5 and above unless you use the notation,
            {!! !!} to circumvent the default behavior for curly braces in Laravel 5. The default behavior for curly
            braces in Laravel 5 causes JSON to unreadable by jqWidgets, since the widget set cannot infer HTML
            entities, such as "&quot", as being a quatation marks (""). Therefore, if you using blade templates and
            need to display JSON from a controller inside a jqWidget, YOU MUST USE the notation {!!  !!}.
            --}}

            {{--
            Get the data returned from the controller (see note above about displaying JSON in Laravel 5 and above) and
            create and initialize the data grid
            --}}

            var data = '{!! $data !!}';

            var source =
            {
                datatype: "json",
                datafields: [{ name: 'id', type: 'string'},
                             { name: 'abbreviation', type: 'string' },
                             { name: 'description', type: 'string' },
                             { name: 'comment', type: 'string' }],
                id: 'id',
                localdata: data
            };


            var renderer = function(row)
            {
                var path = "{!! url('/roles/') !!}" + "/" + JSON.parse(data)[row].id;

                return  '<form method="POST" action="' + path + '" accept-charset="UTF-8">' +
                        '<input name="_method" type="hidden" value="DELETE">' +
                        '<input type="hidden" name="_token" value="{!! csrf_token() !!}">' +
                        '<button type="submit" class="btn btn-default" value="Delete">' +
                        '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            }

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
                    {
                        width: 1000,
                        autoheight: true,
                        altrows: true,
                        source: dataAdapter,
                        columnsresize: true,
                        columns: [{ text: 'ID', datafield: 'id', width: 25, hidden:true },
                            { text: 'Abbreviation', datafield: 'abbreviation', width: 250 },
                            { text: 'Description', datafield: 'description', width: 250 },
                            { text: 'Comment', datafield: 'comment', width: 460 },
                            { text: '', datafield: 'Delete',  cellsrenderer: renderer, width:40}]
                    });

            {{--
            Function listens for a user to double click a row in the grid. If a double click event is captured, the
            function determine which row was double clicked, get the id associated with the selected user's
            information and routes the application to the user info page for additional details about the selected
            user.
            --}}
            $("#jqxgrid").bind('rowclick', function (event)
            {
                click = new Date();
                if (click - lastClick < 300)
                {
                    if (lastRow == event.args.rowindex)
                    {
                        var row = event.args.rowindex;
                        var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
                        window.location.assign('/roles/' + datarow.id + '/edit');
                    }
                }
                lastClick = new Date();
                lastRow = event.args.rowindex;
            });
        });

    </script>
@stop


@section('content')
    <div class="row">
        <h3>All Roles</h3>
    </div>
    <div class="row">
        <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
            <div id="jqxgrid"></div>
        </div>
    </div>
@stop