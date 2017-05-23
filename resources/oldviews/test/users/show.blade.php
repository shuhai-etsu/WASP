@extends('layouts.wasp')

@section('content')

    <div>
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#sectionA">User</a></li>
                <li><a data-toggle="tab" href="#sectionB">Contact Information</a></li>
                <li><a data-toggle="tab" href="#sectionC">Addresses</a></li>
                <li><a data-toggle="tab" href="#sectionD">Emergency Contacts</a></li>
            </ul>

            <div class="tab-content">
                <div id="sectionA" class="tab-pane fade in active">
                        <div class="form-group">
                            <br/>
                            <label name="first" class="form-control">First Name: <input name="firstname" value="{{$user->first_name}}" disabled></label>
                            <label name="middle" class="form-control">Middle Name: <input name="middlename" value="{{$user->middle_name}}" disabled></label>
                            <label name="last" class="form-control">Last Name: <input name="lastname" value="{{$user->last_name}}" disabled></label>
                            <label name="email" class="form-control">Email: <input name="email" value="{{$user->email}}" disabled></label>

                            {{--
                            <ul class="list-group">
                                <li class="list-group-item">First Name: {{$user->first_name}} </li>
                                <li class="list-group-item">Middle Name: {{$user->middle_name}} </li>
                                <li class="list-group-item">Last Name: {{$user->last_name}} </li>
                                <li class="list-group-item">Email: {{$user->email}} </li>
                            </ul>
                            --}}
                        </div>
                </div>

                <div id="sectionB" class="tab-pane fade">
                    <p>Info goes here</p>
                </div>
                <div id="sectionC" class="tab-pane fade">
                        <div class="form-group">
                           @foreach($user->addresses as $address)
                                <label name="address1" class="form-control">Address 1: <input name="address1" value="{{$address->address1}}" disabled></label>
                                <label name="address2" class="form-control">Address 2: <input name="address2" value="{{$address->address2}}" disabled></label>
                                <label name="city" class="form-control">City: <input name="city" value="{{$address->city}}" disabled></label>
                                <label name="state" class="form-control">State: <input name="state" value="{{$address->state}}" disabled></label>
                                <label name="zipcode" class="form-control">Zip Code: <input name="zipcode" value="{{$address->zipcode}}" disabled></label>
                                <hr>
                           @endforeach
                        </div>
                </div>
            </div>
        </div>



        {{--
        @foreach($user->addresses as $address)
            <ul class="list-group"></ul>
                <li class="list-group-item">Address 1: {{$address->address1}} </li>
                <li class="list-group-item">Address 2: {{$address->address2}} </li>
                <li class="list-group-item">City: {{$address->city}} </li>
                <li class="list-group-item">State: {{$address->state}} </li>
                <li class="list-group-item">Zip Code: {{$address->zipcode}} </li>
            </ul>
        @endforeach

        <form>
            <div class="form-group">
                <label>Add address</label>
                <label name="address1" class="form-control">Address 1: <input name="address1"></label>
                <label name="address2" class="form-control">Address 2: <input name="address2"></label>
                <label name="city" class="form-control">City: <input name="city"></label>
                <label name="state" class="form-control">State: <input name="state"></label>
                <label name="zipcode" class="form-control">Zip Code: <input name="zipcode"></label>
            </div>
        </form>

        --}}
    </div>
@stop