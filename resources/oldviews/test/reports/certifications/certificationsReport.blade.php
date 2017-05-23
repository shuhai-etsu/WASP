@extends('layouts.wasp')

@section('content')

    <div class="container">
        <div class="form-group">
            <div class="col-sm-10">
                <br/>
                <h3><b>Employee Certifications Report</b></h3>
                <br/>
                @foreach($users as $user)
                    <b>{{"(" . ($loop->index +1) . ") "}} </b> {{$user->last_name . ', ' . $user->first_name}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Certification</th>
                                <th>Date Certified</th>
                                <th>Expires</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-8">{{$user->certification}}</td>
                                <td class="col-md-2">{{Carbon\Carbon::parse($user->date_certified)->format('m/d/Y')}}</td>
                                <td class="col-md-2">{{Carbon\Carbon::parse($user->expiration_date)->format('m/d/Y')}}</td>
                            </tr>
                       </tbody>
                    </table>
                    <br/>
                @endforeach
                <div><b>Total Records:</b> {{$users->count()}}</div>
            </div>
        </div>
    </div>
@stop

