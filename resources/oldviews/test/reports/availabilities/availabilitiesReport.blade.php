@extends('layouts.wasp')

@section('content')

    <div class="container">
        <div class="form-group">
            <div class="col-sm-10">
                <br/>
                <br/>
                <h2>User Availabilities Report</h2>
                <br/>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Classroom</th>
                        <th>Weekday</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->last_name . ", " . $item->first_name}}</td>
                            <td>{{$item->semester}}</td>
                            <td>{{$item->classroom}}</td>
                            <td>{{$item->weekday}}</td>
                            <td>{{date("g:i a", strtotime($item->start_time))}}</td>
                            <td>{{date("g:i a", strtotime($item->end_time))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div><b>Total Records:</b> {{$data->count()}}</div>
            </div>
        </div>
    </div>
@stop

