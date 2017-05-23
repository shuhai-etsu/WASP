@extends('layouts.wasp')

@section('content')

    <div class="container">
        <div class="form-group">
            <div class="col-sm-10">
                <br/>
                <br/>
                <h2>Financial Aid Recipient Report</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Financial Aid</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->last_name}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->description}} ({{$item->abbreviation}})</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div><b>Total Records:</b> {{$data->count()}}</div>
            </div>
        </div>
    </div>
@stop

