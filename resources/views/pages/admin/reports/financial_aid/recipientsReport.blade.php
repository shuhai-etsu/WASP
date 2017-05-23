@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/reports.js') }}"></script>
@endpush

@section('title')
    Financial Aid Recipient Report
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
                    <th>Financial Aid</th>
                </tr>
            @stop

            @section('table_rows')
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td>{{$item->description}} ({{$item->abbreviation}})</td>
                    </tr>
                @endforeach
            @stop
            @include('template.table')
        </div>
        <div><b>Total Records:</b> {{$data->count()}}</div>
    </div>
    @include('pages.modal.user_help.financial_aid_recipient_report_page')
@stop