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

            var data = '{!! $data->addresses !!}';

            var source =
            {
                datatype: "json",
                datafields: [ { name: 'id', type: 'string'},
                              { name: 'address1', type: 'string' },
                              { name: 'address2', type: 'string' },
                              { name: 'comment', type: 'string'},
                              { name: 'city', type: 'string' }],

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
                var path = "{!! url('/user_addresses/') !!}" + "/" + JSON.parse(data)[row].id;

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
                                  { text: 'Address 1', datafield: 'address1', width: 230 },
                                  { text: 'Address 2', datafield: 'address2', width: 230 },
                                  { text: 'City', datafield: 'city', width: 250 },
                                  { text: 'Comment', datafield: 'comment', width: 250 },
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
                        window.location.assign('/user_addresses/' + datarow.id + '/edit');
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
            <h3>Current Addresses for {!! $data->first_name . ' ' . $data->last_name !!}</h3>
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
            <h3> Add an Address</h3>
            {{  Form::open( [ 'route' => 'user_addresses.store' ] )  }}
            <div class="form-group">
                {{  Form::hidden('user_id', $data->id) }}
                {{  Form::label('address1', 'Address 1: ')  }}
                {{  Form::text('address1', null, array('class' => 'form-control'))  }}
                {{  $errors->first('address1', '<div class="alert alert-danger"><b>:message</b></div>')  }}
            </div>
            <div class="form-group">
                {{  Form::label('address2', 'Address 2: ')  }}
                {{  Form::text('address2', null, array('class' => 'form-control'))  }}
                {{  $errors->first('address2', '<div class="alert alert-danger"><b>:message</b></div>')  }}
            </div>
            <div class="form-group">
                {{  Form::label('city', 'City: ')  }}
                {{  Form::text('city', null, array('class' => 'form-control'))  }}
                {{  $errors->first('city', '<div class="alert alert-danger"><b>:message</b></div>')  }}
            </div>
            <div class="form-group">
                {{ Form::label('state_id', 'State: ')  }}
                {{ Form::select('state_id', $states) }}
                {{ $errors->first('state_id', '<div class="alert alert-danger"><b>:message</b></div>')  }}
            </div>
            <div class="form-group">
                {{  Form::label('zipcode', 'Zip Code: ')  }}
                {{  Form::text('zipcode', null, array('class' => 'form-control'))  }}
                {{  $errors->first('zipcode', '<div class="alert alert-danger"><b>:message</b></div>')  }}
            </div>
            <div class="form-group">
                {{  Form::label('comment', 'Comment: ')  }}
                {{  Form::text('comment', null, array('class' => 'form-control'))  }}
                {{  $errors->first('comment', '<div class="alert alert-danger"><b>:message</b></div>')  }}
            </div>
            <div class="form-group">
                {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
            </div>

            {{  Form::close()  }}
        </div>
@stop


