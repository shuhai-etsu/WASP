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

            @foreach($user->references as $reference)
                data.push
                (
                    {
                        id: {{ $reference->id  }},
                        user_id: {{ $reference->user_id }},
                        first_name: '{{ $reference->first_name  }}',
                        middle_name: '{{ $reference->middle_name }}',
                        last_name: '{{ $reference->last_name }}',
                        telephone_number: '{{  $reference->telephone_number }}',
                        type_id: {{ $reference->type_id }},
                        comment: '{{ $reference->comment }}'

                    }
                );

            @endforeach

            var source =
            {
                datatype: 'array',
                datafields: [ { name: 'id', type: 'string'},
                              { name: 'first_name', type: 'string' },
                              { name: 'last_name', type: 'string' },
                              { name: 'telephone_number', type: 'string'},
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
            var renderer = function(row)
            {
                var path = '{!! url('/user_references/') !!}' + '/' + $("#jqxgrid").jqxGrid('getrowdata', row).id;

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
                                  { text: 'First Name', datafield: 'first_name', width: 200 },
                                  { text: 'Last Name', datafield: 'last_name', width: 200 },
                                  { text: 'Telephone #', datafield: 'telephone_number', width: 200 },
                                  { text: 'Comment', datafield: 'comment', width: 360 },
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
                        window.location.assign('/user_references/' + data.id + '/edit');
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
            <h3>References   for {!! $user->first_name . ' ' . $user->last_name !!}</h3>
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
                    <h3><b>Add Reference</b></h3>
                    <br>
                </div>

            </div>

            {{  Form::open(['route' => 'user_references.store', 'class' => 'form-horizontal', 'role' => 'form']) }}

            <div class="form-group">

                {{  Form::hidden('user_id', $user->id) }}
                {{  Form::label('first_name', 'First Name:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{  Form::text('first_name', null, array('class' => 'form-control',
                                                                          'maxlength' => '25',
                                                                          'id' => 'first_name'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('middle_name', 'Middle Name:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{  Form::text('middle_name', null, array('class' => 'form-control',
                                                                         'maxlength' => '25',
                                                                         'id' => 'middle_name'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('last_name', 'Last Name:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{  Form::text('last_name', null, array('class' => 'form-control',
                                                                       'maxlength' => '25',
                                                                       'id' => 'last_name'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('telephone', 'Telephone #:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-2">
                    {{  Form::text('telephone_number', null, array('class' => 'form-control',
                                                                   'maxlength' => '15',
                                                                   'id' => 'telephone_number'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('type_id', 'Telephone Type:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-2">
                    {{  Form::select('type_id', $telephone_types, null, ['id' => 'type_id',
                                                                         'class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('comment', 'Comment:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-8">
                    {{  Form::text('comment', null, array('class' => 'form-control',
                                                          'maxlength' => '255',
                                                          'id' => 'comment'))  }}
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
