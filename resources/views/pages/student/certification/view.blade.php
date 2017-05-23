@extends('template.layout_sidebar')

@section('title')
    Certification
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @if($certification)
        @section('table_headers')

            <tr>
                <th>Certification</th>
                <th>Certification date</th>
                <th>Expiration date</th>
               {{-- <th>Certification</th>--}}{{--document probably--}}
            </tr>

        @stop
        @section('table_rows')
            @foreach($certification as $part)
                <tr>
                    <td>{{$part->description}}</td>
                    <td> {{date('m/d/Y',strtotime($part->date_certified))}}</td>
                    <td>{{date('m/d/Y',strtotime($part->expiration_date))}}</td>
                   {{-- <td><a href="#">CPS</a></td>--}}
                </tr>
            @endforeach
        @stop
        @endif
        @include('template.table')
    </div>
    <div class="row">
        <a id="availabilities_id" class="btn btn-primary pull-left" href="{{URL::to('/studentCertification/create')}}" style="position:relative;bottom: 34px;">New Certification</a>
    </div>
    @include('pages.modal.user_help.student_certification_view')
@stop