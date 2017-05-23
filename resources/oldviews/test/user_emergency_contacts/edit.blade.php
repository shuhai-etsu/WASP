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
            <h3> Edit Emergency Contact</h3>
        </div>
        {{ Form::model($data, array('route' => array('user_emergency_contacts.update', $data->id), 'method' => 'PUT')) }}
            <div class="form-group">
                {{  Form::hidden('user_id', $data->user_id)  }}
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
                {{ Form::label('suffix_id', 'Suffix: ')  }}
                {{ Form::select('suffix_id', $suffixes) }}
             </div>

            <div class="form-group">
                {{ Form::label('gender_id', 'Gender: ')  }}
                {{ Form::select('gender_id', $genders) }}
            </div>

            <div class="form-group">
                {{ Form::label('relationship_id', 'Relationship: ')  }}
                {{ Form::select('relationship_id', $relationships) }}
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