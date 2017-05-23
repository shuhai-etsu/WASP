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
        <h3> Add a Building</h3>
        {{  Form::open( [ 'route' => 'buildings.store' ] )  }}
        <div class="form-group">
            {{  Form::label('abbreviation', 'Abbreviation: ')  }}
            {{  Form::text('abbreviation', null, array('class' => 'form-control'))  }}
        </div>
        <div class="form-group">
            {{  Form::label('description', 'Description: ')  }}
            {{  Form::text('description', null, array('class' => 'form-control'))  }}
        </div>
        <div class="form-group">
            {{  Form::label('address1', 'Address 1: ')  }}
            {{  Form::text('address1', null, array('class' => 'form-control'))  }}
        </div>
        <div class="form-group">
            {{  Form::label('address2', 'Address 2: ')  }}
            {{  Form::text('address2', null, array('class' => 'form-control'))  }}
        </div>
        <div class="form-group">
            {{  Form::label('city', 'City: ')  }}
            {{  Form::text('city', null, array('class' => 'form-control'))  }}
        </div>
        <div class="form-group">
            {{ Form::label('state_id', 'State: ')  }}
            {{ Form::select('state_id', $states) }}
        </div>
        <div class="form-group">
            {{  Form::label('zipcode', 'Zip Code: ')  }}
            {{  Form::text('zipcode', null, array('class' => 'form-control'))  }}
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


