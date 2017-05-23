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

        {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

        <h3> Edit User </h3>
        <div class="form-group">
            <br>
            [ <a href="/users/{!! $user->id !!}/addresses">Address(s)</a> ]
             [ <a href="/users/{!! $user->id !!}/telephones">Contact Info.</a>  ]
            {{--<a href="/users/{!! $user->id !!}/emails">Email Address(s)</a>  | --}}
             [ <a href="/users/{!! $user->id !!}/emergency_contacts">Emergency Contact(s)</a> ]
             [ <a href="/users/{!! $user->id !!}/availabilities">Availabilities</a> ]
             [ <a href="/users/{!! $user->id !!}/education">Education</a> ]
             [ <a href="/users/{!! $user->id !!}/philosophies">Philosophies</a> ]
             [ <a href="/users/{!! $user->id !!}/references">References</a> ]
        </div>

        <div class="form-group">
            {{  Form::hidden('id', $user->id) }}
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
            {{ Form::select('suffix_id', $suffixes, array($user->suffix_id), array('id' => 'suffixID')) }}
        </div>

        <div class="form-group">
            {{ Form::label('gender_id', 'Gender: ')  }}
            {{ Form::select('gender_id', $genders, array($user->gender_id), array('id' => 'genderID')) }}
        </div>

        <div class="form-group">
            {{  Form::label('email', 'Email Address: ')  }}
            {{  Form::text('email', null, array('class' => 'form-control'))  }}
        </div>

        <div class="form-group">
            {{  Form::label('alternate_email', 'Alternate Email: ')  }}
            {{  Form::text('alternate_email', null, array('class' => 'form-control'))  }}
        </div>

        <div class="form-group">
            {{  Form::label('password', 'Password: ')  }}
            {{  Form::text('password', null, array('class' => 'form-control'))  }}
        </div>

        <div class="form-group">
            {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
        </div>

        {{  Form::close()  }}
    </div>
@stop