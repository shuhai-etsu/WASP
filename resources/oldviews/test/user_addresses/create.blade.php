@extends('layouts.wasp')

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
        <div class="form-group">
            <h3></h3>
        </div>
        <div class="col-md-offset-2">

            {{ Form::open( ['route' => 'user_create_telephone', 'class'=>'form-horizontal', 'role'=>'form']) }}

            <div class="form-group">

                {{ Form::label('address1', 'Address 1:', array('for'=>'address1', 'class'=>'col-sm-2 control-label')) }}

                <div class="col-sm-6">
                    {{ Form::text('address1', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
                </div>

            </div>

            <div class="form-group">
                {{ Form::label('address2', 'Address 2:', array('for'=>'address2', 'class'=>'col-sm-2 control-label')) }}

                <div class="col-sm-6">
                    {{ Form::text('address2', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
                </div>
            </div>

            <div class="form-group">
               {{ Form::label('city', 'City:', array('for'=>'city', 'class'=>'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{ Form::text('city', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('state_id', 'State:', array('for'=>'state_id', 'class'=>'col-sm-2 control-label')) }}

                <div class="col-sm-2">
                    {{ Form::select('state_id', $states) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('zipCode', 'Zip Code:', array('for'=>'zipcode', 'class'=>'col-sm-2 control-label')) }}

                <div class="col-sm-3">
                    {{ Form::text('zipcode', null, array('class' => 'form-control', 'maxlength'=>'50', 'placeholder'=>'')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('comment', 'Comment:', array('for'=>'comment', 'class'=>'col-sm-2 control-label')) }}

                <div class="col-sm-6">
                    {{ Form::textarea('comment', null, array('class' => 'form-control', 'rows'=>'2')) }}
                </div>
            </div>

            <div class="form-group">
                <br>
                <br>
                <div class="col-sm-offset-2 col-sm-10">
                    {{ Form::submit('Save', array('class' => 'btn btn-info')) }}
                </div>
            </div>
        </div>

        {{ Form::close() }}
        
    </div>
@stop