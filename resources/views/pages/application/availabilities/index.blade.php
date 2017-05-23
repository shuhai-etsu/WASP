@extends('template.layout_no_sidebar')

@section('head')
    @push('css')
        <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />
    @endpush
    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
    @endpush
@endsection

@section('title')
    ETSU Child Study Center Student Worker Application - Availabilities
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @section('table_headers')
            <tr>
                <th>Semester</th>
                <th>Weekday</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Comment</th>
                <th class="no-sort" style="width: 30px;">Action</th>
            </tr>
        @stop

        @section('table_rows')
            @foreach($availabilities as $row)
                <tr>
                    <td>{{$row->semester}}</td>
                    <td>{{$row->weekday}}</td>
                    <td>{{$row->start_time}}</td>
                    <td>{{$row->end_time}}</td>
                    <td>{{$row->comment}}</td>
                    <td>
                        @include('template.table_button', array('button_link'=> URL::to('user_availabilities/'.$row->id.'/edit')))
                    </td>
                </tr>
            @endforeach
        @stop
        
        @include('template.table')
    </div>

    <a class="btn btn-primary pull-left" href="{{URL::to('user_availabilities/create')}}" style="position:relative;bottom: 34px;">New Availability</a>
    <br/>
@stop