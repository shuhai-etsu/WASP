@extends('layouts.wasp')

@section('content')

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
        <h3> Edit Address</h3>

        {{ Form::model($data, array('route' => array('user_addresses.update', $data->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::hidden('user_id', $data->user_id) }}
            {{ Form::label('address1', 'Address 1:', array('for'=>'address1', 'class'=>'col-sm-2 control-label')) }}
            {{ Form::text('address1', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
        </div>

        <div class="form-group">
            {{ Form::label('address2', 'Address 2:', array('for'=>'address2', 'class'=>'col-sm-2 control-label')) }}
            {{ Form::text('address2', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
        </div>

        <div class="form-group">
            {{ Form::label('city', 'City:', array('for'=>'city', 'class'=>'col-sm-2 control-label')) }}
            {{ Form::text('city', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
        </div>

        <div class="form-group">
            {{ Form::label('state_id', 'State:', array('for'=>'state_id', 'class'=>'col-sm-2 control-label')) }}
            {{ Form::select('state_id', $states) }}
        </div>

        <div class="form-group">
            {{ Form::label('zipCode', 'Zip Code:', array('for'=>'zipcode', 'class'=>'col-sm-2 control-label')) }}
            {{ Form::text('zipcode', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
        </div>

        <div class="form-group">
            {{ Form::label('comment', 'Comment:', array('for'=>'comment', 'class'=>'col-sm-2 control-label')) }}
            {{ Form::textarea('comment', null, array('class' => 'form-control', 'rows'=>'2')) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Save', array('class' => 'btn btn-info')) }}
        </div>
    </div>
@stop


