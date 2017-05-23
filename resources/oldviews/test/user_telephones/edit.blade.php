@extends('layouts.wasp')

@section('content')
    <div class="row">


        <div class="form-group">
            <h3> Edit Telephone Number</h3>
        </div>

        {{ Form::model($data, array('route' => array('user_telephones.update', $data->id), 'method' => 'PUT')) }}
        <div class="form-group">
            {{  Form::hidden('user_id', $data->user_id) }}
            {{  Form::label('telephone_number', 'Telephone #: ')  }}
            {{  Form::text('telephone_number', null, array('class' => 'form-control'))  }}

        </div>
        <div class="form-group">
            {{ Form::label('type_id', 'Type: ')  }}
            {{ Form::select('type_id', $telephone_types) }}

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