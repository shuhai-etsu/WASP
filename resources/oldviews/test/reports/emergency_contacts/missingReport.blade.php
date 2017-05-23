@extends('layouts.wasp')

@section('content')

    <div class="container">
        <div class="form-group">
            <div class="col-sm-10">
                <br/>
                <br/>
                <h2>Missing Emergency Contact Information Report</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->middle_name}}</td>
                            <td>{{$user->role}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div><b>Total Records:</b> {{$users->count()}}</div>
            </div>
        </div>
    </div>
@stop

