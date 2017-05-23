@extends('layouts.wasp')

@section('content')

<div class="container">
        {{  Form::open(['route' => 'age_group_types.store',
                                   'class' => 'form-horizontal',
                                   'role' => 'form']) }}

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

        <div class="form-group">
            <div class="col-sm-12 control-label">
                <h3><b>Add Security Privilage</b></h3>
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('abbreviation', 'Abbreviation:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-2">
                {{  Form::text('abbreviation', null, array('class' => 'form-control',
                                                                      'maxlength' => '10',
                                                                      'id' => 'abbreviation'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('description', 'Description:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-7">
                {{  Form::text('description', null, array('class' => 'form-control',
                                                                     'maxlength' => '50',
                                                                     'id' => 'description'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('comment', 'Comment:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-7">
                {{  Form::textarea('comment', null, array('class' => 'form-control',
                                                                     'rows' => '3',
                                                                     'maxlength' => '255',
                                                                     'id' => 'comment'))  }}
            </div>
        </div>

        <div class="form-group">
           <div class="col-sm-offset-2 col-sm-10">
              {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
           </div>
        </div>

        {{ Form::close() }}
</div>
@stop