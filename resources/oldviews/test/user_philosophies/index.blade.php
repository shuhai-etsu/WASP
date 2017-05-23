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

            @foreach($user->philosophies as $obj)
                data.push
                (
                    {
                        id: {{ $obj->id  }},
                        user_id: {{ $obj->user_id }},
                        type: '{{ $obj->type->description }}',
                        philosophy: '{{ $obj->philosophy }}'
                    }
                );

            @endforeach

            var source =
            {
                datatype: 'array',
                datafields: [ { name: 'id', type: 'string'},
                              { name: 'type', type: 'string' },
                              { name: 'philosophy', type: 'string' }],

                id: 'id',
                localdata:data
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            /**
             *
             * @param row
             * @returns {string}
             */
            var renderer = function(row)
            {
                var path = '{!! url('/user_philosophies/') !!}' + '/' + $("#jqxgrid").jqxGrid('getrowdata', row).id;

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
                                  { text: 'Type', datafield: 'type', width: 260 },
                                  { text: 'Philosophy', datafield: 'philosophy', width: 700 },
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
                        var data = $("#jqxgrid").jqxGrid('getrowdata', row);
                        window.location.assign('/user_philosophies/' + data.id + '/edit');
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
            <h3>Philosophies for {!! $user->first_name . ' ' . $user->last_name !!}</h3>
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
            <div class="form-group">
                <br>
                <br>
                <div class="col-sm-12 control-label">
                    <h3><b>Add Philosophy</b></h3>
                    <br>
                </div>

            </div>

            {{  Form::open(['route' => 'user_philosophies.store', 'class' => 'form-horizontal', 'role' => 'form']) }}

            <div class="form-group">
                {{  Form::hidden('user_id', $user->id) }}
                {{  Form::label('type_id', 'Philosophy Type:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-2">
                    {{  Form::select('type_id', $philosophy_types, null, ['id' => 'type_id',
                                                                         'class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group">

                {{  Form::label('philosophy', 'Philosophy:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-8">
                    {{  Form::textarea('philosophy', null, array('class' => 'form-control',
                                                                            'maxlength' => '65000',
                                                                            'rows' => '4',
                                                                            'cols' => '50',
                                                                            'id' => 'philosophy'))  }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
                </div>
            </div>

            {{  Form::close()  }}

        </div>
@stop
