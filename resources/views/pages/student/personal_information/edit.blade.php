@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/student_personal_info.js') }}"></script>
@endpush

@section('title')
   Personal Information
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
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

    {{--
    ***IMPORTANT*** Any select form's default selection is decreased by one since the form begins at zero and
    database IDs begin at one.

    @todo Validate the form fields before they reach the backend
    --}}

    <div class="row create-form">
        {{ Form::model($data.$telephones, array('id'=>'user_profile','route' => array('studentPersonalInformation.update_personal_info', $data->id),
                              'class' => 'form-horizontal',
                              'role' => 'form',
                              'method' => 'PATCH')) }}
        <div class="form-group">
            {{  Form::hidden('id', $data->id) }}
        </div>

        @if($addresses)
            @foreach($addresses as $part)
                <div class="row form-group">
                    {{  Form::label('address1', 'Address', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-5">
                        {{  Form::text('address1',$part->address1, array('class' => 'form-control',
                                                                  'placeholder' =>'For Example: 123 Fake Street',
                                                                  'maxlength' => '255',
                                                                  'id' => 'addr1'))  }}
                    </div>
                </div>
                <div class="row form-group">
                    {{  Form::label('address2', 'Address 2', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-5">
                        {{  Form::text('address2',$part->address2, array('class' => 'form-control',
                                                                  'placeholder' =>'For Example: Suite 550',
                                                                  'maxlength' => '255',
                                                                  'id' => 'addr2'))  }}
                    </div>
                </div>
                <div class="row form-group">
                    {{  Form::label('city', 'City', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-5">
                        {{  Form::text('city',$part->city, array('class' => 'form-control',
                                                                  'placeholder' =>'For Example: Johnson City',
                                                                  'maxlength' => '255',
                                                                  'id' => 'city'))  }}
                    </div>
                </div>
                <div class="row form-group">
                    {{  Form::label('state', 'State', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-5">
                        {{ Form::select('state', $states,$part->state_id -1, array('id' => 'state', 'class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row form-group">
                    {{  Form::label('zip', 'Zip', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-5">
                        {{  Form::text('zip',$part->zipcode, array('class' => 'form-control',
                                                                  'placeholder' =>'For Example: 12345-1234',
                                                                  'maxlength' => '10',
                                                                  'id' => 'zip'))  }}
                    </div>
                </div>
            @endforeach
        @endif
        @if($telephones)
            @foreach($telephones as $phone)
                <div class="row form-group">
                    {{  Form::label('number', 'Telephone Number', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-5">
                        {{  Form::text('telephone_number[]',$phone->telephone_number, array('class' => 'form-control',
                                                                  'placeholder' =>'For Example: 4231231234',
                                                                  'maxlength' => '14',
                                                                  'id' => 'telenum'))  }}
                    </div>
                </div>

                <div class="row form-group">
                    {{  Form::label('type', 'Telephone Type', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-5">
                        {{ Form::select('telephone_type[]',  $telephone_types, $phone->type_id -1, array('id' => 'telephone_type', 'class' => 'form-control')) }}
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group">
            {{  Form::label('email', 'Alternate Email', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('email',isset($data->alternate_email)? $data->alternate_email:null, array('class' => 'form-control',
                                                'placeholder' => 'For Example: DoeJane@gmail.com',
                                                'id' => 'email'))  }}
            </div>
        </div>
        @if($fin_aid)
            <div class="form-group row">
                {{ Form::label('worker_type', 'Financial aid', array('class'=>'control-label col-sm-2'))  }}
                <div class="col-xs-3">
                    {{ Form::select('worker_type', $fin_aid_types, $fin_aid->pluck('type_id')->transform(function ($item, $key) {return $item-1;})->all(), array('id' => 'worker_type', 'size'=> '11', 'style'=> 'width:500px;', 'class' => 'form-control', 'multiple'=>'multiple')) }}
                </div>
            </div>
        @endif

        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                <a class="btn btn-default" href="{{URL::to('/studentPersonalInformation')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.student_personalInformation_view')
@endsection