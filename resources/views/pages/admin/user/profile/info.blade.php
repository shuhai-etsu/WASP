@extends('template.layout_sidebar')
@section('title')
    @if($data)
        {{$data->first_name . ' ' . $data->last_name}}
    @endif
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
    <ul class="nav nav-tabs">
        <li class="active"><a href="">Personal Information</a></li>
        <li><a href="/profile/{{$data->id}}/emergency_contacts">Emergency Contact</a></li>
        <li><a href="/profile/{{$data->id}}/availabilities">Availabilities</a></li>
        <li><a href="/profile/{{$data->id}}/certifications">Certifications</a></li>
        <li><a href="/profile/{{$data->id}}/education">Education</a></li>
        <li><a href="/profile/{{$data->id}}/work_experience">Work Experience</a></li>
        <li><a href="/profile/{{$data->id}}/documents">Documents</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            <p>
                {{$data->enumber}}
            </p>
            @if($addresses)
                @foreach($addresses as $part)
                    <p>
                        Address: {{$part->address1 .' '. $part->address2}}
                        <p>
                            City: {{$part->city}}
                        </p>
                        <p>
                            State: {{$part->description}}
                        </p>
                        <p>
                            Zip: {{$part->zipcode}}
                        </p>
                    </p>
                @endforeach
            @endif
            @if($telephones)
                @foreach($telephones as $phone)
                <p>
                    {{$phone->description}} Phone: {{$phone->telephone_number}}
                </p>
                @endforeach
            @endif
            <p>
                Email: {{$data->email}}
            </p>
            @if($fin_aid)
                @foreach($fin_aid as $aid)
                <p>
                    Financial Aid: {{$aid->description}}
                </p>
                @endforeach
            @endif
        </div>
    </div>
    @include('template.table_button', array('button_link'=> URL::to('/profile/'.$data->id.'/info/edit')))
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection