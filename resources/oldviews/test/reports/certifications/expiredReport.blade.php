@extends('layouts.wasp')

@section('content')

    <div class="container">
        <div class="form-group">
            <div class="col-sm-10">
                <br/>
                <br/>
                <h2>Expired Certifications Report</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Certification</th>
                        <th>Date Expired</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->last_name}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->description}} ({{$item->abbreviation}})</td>
                            <td>{{Carbon\Carbon::parse($item->expiration_date)->format('m/d/Y')}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div><b>Total Records:</b> {{$data->count()}}</div>
            </div>
        </div>
    </div>
@stop

