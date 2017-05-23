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

            var data = '{!! $data !!}';

            var source =
            {
                datatype: "json",
                datafields: [{ name: 'id', type: 'string'},
                             { name: 'first_name', type: 'string'},
                             { name: 'middle_name', type: 'string' },
                             { name: 'last_name', type: 'string' },
                             { name: 'email', type: 'string' },
                             { name: 'telephone', type: 'string' }],
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
                var path = "{!! url('/users/') !!}" + "/" + JSON.parse(data)[row].id;

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
                                  { text: 'Middle Name', datafield: 'middle_name', width: 200 },
                                  { text: 'Last Name', datafield: 'last_name', width: 200 },
                                  { text: 'Email', datafield: 'email', width: 200 },
                                  { text: 'Telephone', datafield: 'telephone', width: 160},
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
                        window.location.assign('/users/' + datarow.id + '/edit');
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
        <h3>Find a User</h3>

         {!! Form::open(array('route' => 'user_search', 'class' => 'form')) !!}


        <div class="form-group">
            {{  Form::label('first_name', 'First Name: ')  }}
            {{  Form::text('first_name', null, array('class' => 'form-control'))  }}
        </div>

        <div class="form-group">
            {{  Form::label('middle_name', 'Middle Name: ')  }}
            {{  Form::text('middle_name', null, array('class' => 'form-control'))  }}
        </div>

        <div class="form-group">
            {{  Form::label('last_name', 'Last Name: ')  }}
            {{  Form::text('last_name', null, array('class' => 'form-control'))  }}
        </div>

        <div class="form-group">
            {{  Form::label('email', 'Email address: ')  }}
            {{  Form::text('email', null, array('class' => 'form-control'))  }}
        </div>

        <div class="form-group">
            {{  Form::submit('Search', array('class' => 'btn btn-info'))  }}
        </div>
        {{  Form::close()  }}
    </div>

    @if($data)
        <div class="row">
            <br>
            <h3>Search Results</h3>
        </div>
        <div class="row">
            <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
                <div id="jqxgrid"></div>
            </div>
        </div>
    @endif
@stop