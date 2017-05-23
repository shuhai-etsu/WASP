@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/user_search.js') }}"></script>
@endpush

@section('title')
    User Search
    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    @if (count($errors) > 0)
        <div class="form-group col-sm-10">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{ Form::open(array('route' => 'user_search',
                              'class' => 'form-inline simple_search pull-left',
                              'role' => 'form')) }}
    <div>
        <div class="form-group">
            {{--{{  Form::label('last_name', 'Last Name', array('class' => 'control-label col-sm-2')) }}--}}
            <div class="col-xs-3">
                {{  Form::text('last_name',null, array('class' => 'form-control',
                                                          'placeholder' =>'Last Name',
                                                          'id' => 'last_name', 'autofocus'))  }}
            </div>
        </div>
        <div class="form-group">
            {{--{{  Form::label('first_name', 'First Name', array('class' => 'control-label col-sm-2')) }}--}}
            <div class="col-xs-3">
                {{  Form::text('first_name',null, array('class' => 'form-control',
                                                          'placeholder' =>'First Name',
                                                          'id' => 'first_name'))  }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-1">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </div>
    </div>

    {{ Form::close() }}

    <button class="btn btn-primary advanced_search_btn">Advanced Search</button>

{{--Advanced search form--}}
    {{ Form::open(array('route' => 'user_search',
                              'class' => 'form-inline advanced_search hidden',
                              'role' => 'form')) }}
    <div style="padding-bottom: 10px;">
        <div class="form-group">
            <div class="col-xs-3">
                {{  Form::text('last_name',null, array('class' => 'form-control',
                                                          'placeholder' =>'Last Name',
                                                          'id' => 'last_name'))  }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-3">
                {{  Form::text('first_name',null, array('class' => 'form-control',
                                                          'placeholder' =>'First Name',
                                                          'id' => 'first_name'))  }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-3">
                {{  Form::text('email',null, array('class' => 'form-control',
                                                          'placeholder' =>'Email',
                                                          'id' => 'email'))  }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-3">
                {{  Form::text('telephone_number',null, array('class' => 'form-control',
                                                          'placeholder' =>'Telephone',
                                                          'id' => 'telephone_number'))  }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-3">
                {{  Form::text('financial_aid_types',null, array('class' => 'form-control',
                                                          'placeholder' =>'Worker Type',
                                                          'id' => 'financial_aid_types'))  }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-1">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </div>
    </div>


    {{ Form::close() }}

{{--@section('table_class')users-table @stop--}}
    @section('table_headers')
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Worker Type</th>
            <th class="no-sort">Action</th>
        </tr>
    @stop
    @section('table_rows')
        @if($data)
            @foreach($data as $row)
                <tr>
                    <td>{{$row->last_name}}</td>
                    <td>{{$row->first_name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->telephone}}</td>
                    <td>{{$row->financial_aid_type}}</td>
                    <td style="width: 1%;">
                        @include('template.table_button', array('button_link'=> URL::to('profile/'.$row->id.'/info')), array('button_text'=> 'View'))
                    </td>
                </tr>
            @endforeach
        @endif
    @stop

    @include('template.table', array('table_classes' => 'table table-striped table-bordered custab users_table'))
    @include('pages.modal.user_help.user_search')

@stop