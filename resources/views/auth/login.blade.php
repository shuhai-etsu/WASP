@extends('template.layout_no_sidebar')

@section('page')
    <div class="col-md-2 col-md-offset-5">
        {{Form::open(array('url' => '/login', 'class' =>'disable-submit&#x20;form-horizontal'))}}
            <fieldset class="disable-submit&#x20;form-horizontal">
                <div class="form-group ">
                    {{  Form::label('Email', '', ['class' => 'required']) }}
                    {{Form::text("email",'',['required' => 'required', 'autofocus'=>'autofocus','class' => 'form-control'])}}
                </div>
                <div class="form-group ">
                    {{  Form::label('password', 'Password', ['class' => 'required']) }}
                    {{ Form::password('password',['required' => 'required','class' => 'form-control'])}}
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div ><input name="submit" type="submit" class="btn&#x20;btn-primary&#x20;form-control" value="Login"></div>
            </fieldset>
        {{ Form::close() }}
        <br/>

        <div class="row no-visit">
            <a href="http://www.etsu.edu/activate" target="_blank"><span class="glyphicon glyphicon-lock" aria-hidden="true" style=" font-size: large"></span> <span style = "font-size: medium">Password Reset</span></a>


        </div>

        <br />

        <div class="row no-visit">

                <a href="/application/create"><span class="glyphicon glyphicon-edit" aria-hidden="true" style=" font-size: large"></span> <span style = "font-size: medium">Apply Here!</span></a>


        </div>
        <br />
        <!--<a href="https://etsupws.etsu.edu/AccountActivation/" target="_blank">forgot password?</a>-->
    </div>
    <div class="clear"></div>


@stop