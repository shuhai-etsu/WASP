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

            var data = '{!! $availabilities !!}';

            var source =
            {
                datatype: "json",
                datafields: [ { name: 'id', type: 'string'},
                              { name: 'semester', type: 'string'},
                              { name: 'weekday', type: 'string'},
                              { name: 'start_time', type: 'string' },
                              { name: 'end_time', type: 'string' },
                              { name: 'comment', type: 'string'}],
                id: 'id',
                localdata:data
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            /**
             *
             * @param row
             * @returns {string}
             */
            var deleteRenderer = function(row)
            {
                var path = "{!! url('/user_availabilities/') !!}" + "/" + JSON.parse(data)[row].id;

                return  '<form method="POST" action="' + path + '" accept-charset="UTF-8">' +
                        '<input name="_method" type="hidden" value="DELETE">' +
                        '<input type="hidden" name="_token" value="{!! csrf_token() !!}">' +
                        '<button type="submit" class="btn btn-default" value="Delete">' +
                        '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            }

            $("#jqxgrid").jqxGrid(
                    {
                        width: 1000,
                        autoheight: true,
                        altrows:true,
                        source: dataAdapter,
                        columnsresize: true,
                        columns: [{ text: 'ID', datafield: 'id', width: 25, hidden:true},
                                  { text: 'Semester', datafield: 'semester', width: 100 },
                                  { text: 'Weekday', datafield: 'weekday',  width: 100 },
                                  { text: 'Start Time', datafield: 'start_time', width: 100 },
                                  { text: 'End Time', datafield: 'end_time', width: 100 },
                                  { text: 'Comment', datafield: 'comment', width: 560 },
                                  { text: ' ', cellsrenderer: deleteRenderer, width:40}]
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
                        window.location.assign('/user_availabilities/' + datarow.id + '/edit');
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
            <br>
            <h3>Current Availabilities for {!! $user->first_name . ' ' . $user->last_name !!}</h3>
        </div>
        <div class="row">
            <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
                <div id="jqxgrid"></div>
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="row">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="row">
            <br>
            <br>
            <h3> Add Availability</h3>
            {{  Form::open( [ 'route' => 'user_availabilities.store' ] )  }}
            <div class="form-group">
                {{ Form::hidden('user_id', $user->id) }}
                {{ Form::label('semester_id', 'Semester: ')  }}
                {{ Form::select('semester_id', $semesters) }}
            </div>
            <div class="form-group">

                {{ Form::label('weekday_id', 'Weekday: ')  }}
                {{ Form::select('weekday_id', $weekdays) }}
            </div>
            <div class="form-group">
                {{  Form::label('start_time', 'Start Time: ')  }}
                {{  Form::text('start_time', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::label('end_time', 'End Time: ')  }}
                {{  Form::text('end_time', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::label('comment', 'Comment: ')  }}
                {{  Form::text('comment', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
            </div>

            {{  Form::close()  }}
        </div>
@stop


