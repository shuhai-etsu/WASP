@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/reports.js') }}"></script>
@endpush

@section('title')
    Missing Emergency Contact Information Report
    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
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

    <div class="form-group">
        <div id="report" class="margin-left-2 list-table">
            @section('table_headers')
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Role</th>
                </tr>
            @stop
            
            @section('table_rows')
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->middle_name}}</td>
                            <td>{{$user->role}}</td>

                        </tr>
                    @endforeach
            @stop
            @include('template.table')
        </div>

        <div><b>Total Records:</b> {{$users->count()}}</div>
    </div>
    @include('pages.modal.user_help.missing_emergency_contact_information_report')
@stop