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
            {{ Form::model($data, array('route' => array('user_telephones.store', $data->id), 'method' => 'PUT')) }}
            <div class="form-group">
                {{  Form::label('telephone_number', 'Telephone #: ')  }}
                {{  Form::text('telephone_number', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{ Form::label('type_id', 'Type: ')  }}
                {{ Form::select('type__id', $telephone_types) }}
            </div>
            <div class="form-group">
                {{  Form::label('comment', 'Comment: ')  }}
                {{  Form::text('comment', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::submit('Update', array('class' => 'btn btn-info'))  }}
            </div>
            {{  Form::close()  }}
        </div>
    </div>
@stop