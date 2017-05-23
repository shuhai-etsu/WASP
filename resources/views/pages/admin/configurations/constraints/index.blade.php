
@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
@endpush
@section('title')

    Constraints

    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>

@endsection
@section('page')
        <div class="margin-left-2 list-table">
            @section('table_headers')
                <tr>
                    <th>Abbreviation</th>
                    <th>Description</th>
                    <th>Comment</th>
                    <th class="no-sort" style="width: 30px;">Action</th>
                </tr>
            @stop
            @section('table_rows')
                @foreach($data as $row)
                    <tr>
                        <td>{{$row->abbreviation}}</td>
                        <td>{{$row->description}}</td>
                        <td>{{$row->comment}}</td>
                        <td>
                            @include('template.table_button', array('button_link'=> URL::to('constraints/'.$row->id.'/edit')))
                        </td>
                    </tr>
                @endforeach
            @stop
            @include('template.table')
        </div>

        <div class="row">
            <a class="btn btn-primary pull-left" href="{{URL::to('constraints/create')}}" style="position:relative;bottom: 34px;">New Constraint</a>
        </div>
        <br/>
        @include('pages.modal.user_help.configurations')
@stop
