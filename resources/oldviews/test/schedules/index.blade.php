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
            var click = new Date();
            var lastClick = new Date();
            var lastRow = -1;
            var data = new Array();

            @foreach($data as $item)
                data.push
                (
                    {
                        id: '{!! $item->id !!}',
                        abbreviation: '{!! $item->abbreviation !!}',
                        description: '{!! $item->description !!}',
                        semester: '{!! $item->semester->description !!}',
                        classroom: '{!! $item->classroom->description !!}',
                        comment: '{!! $item->comment !!}'
                    }
                );
            @endforeach

            var source =
            {
                datatype: "array",
                datafields: [{ name: 'id', type: 'string'},
                             { name: 'abbreviation', type: 'string' },
                             { name: 'description', type: 'string' },
                             { name: 'semester', type: 'string' },
                             { name: 'classroom', type: 'string' },
                             { name: 'comment', type: 'string' }],
                id: 'id',
                localdata: data
            };


            var renderer = function(row)
            {
                var path = "{!! url('/schedules/') !!}" + "/" + data[row].id;

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
                height:300,
                //autoheight: true,
                altrows: true,
                source: dataAdapter,
                columnsresize: true,
                columns: [{ text: 'ID', datafield: 'id', width: 25, hidden:true },
                          { text: 'Abbreviation', datafield: 'abbreviation', width: 100 },
                          { text: 'Description', datafield: 'description', width: 330 },
                          { text: 'Semester', datafield: 'semester', width: 150 },
                          { text: 'Classroom', datafield: 'classroom', width: 150 },
                          { text: 'Comment', datafield: 'comment', width: 230 },
                          { text: '', datafield: 'Delete',  cellsrenderer: renderer, width:40}]
            });

            $("#jqxgrid").bind('rowclick', function (event)
            {
                click = new Date();
                if (click - lastClick < 300)
                {
                    if (lastRow == event.args.rowindex)
                    {
                        var row = event.args.rowindex;
                        var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
                        window.location.assign('/schedules/' + datarow.id + '/edit');
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
        <h3>All Schedules</h3>
    </div>
    <div class="row">
        <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
            <div id="jqxgrid"></div>
        </div>
    </div>
@stop






