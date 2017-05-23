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
            <h3> Edit Building</h3>
        </div>

        @if (count($data->classrooms) > 0)
            <div class="form-group">
                {!! '<a href="/buildings/' . $data->id . '/classrooms">Classrooms (' . count($data->classrooms) . ')</a>' !!}
            </div>
        @endif

        {{ Form::model($data, array('route' => array('buildings.update', $data->id), 'method' => 'PUT')) }}
        <div class="form-group">
            {{  Form::hidden('id', $data->id) }}
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
            {{ Form::label('state_id', 'Suffix: ')  }}
            {{ Form::select('state_id', $states, array($data->state_id), array('id' => 'stateID')) }}
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