@extends('template.layout_sidebar')

@section('title')
    Age Group
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
                            @include('template.table_button', array('button_link'=> URL::to('age_group_types/'.$row->id.'/edit')))
                        </td>
                    </tr>
                @endforeach
            @stop
            
            @include('template.table')
        </div>

        <div class="row">
            <a id="age_group_type_id" class="btn btn-primary pull-left" href="{{URL::to('age_group_types/create')}}" style="position:relative;bottom: 34px;">New Age Group</a>
        </div>
        <br/>
        @include('pages.modal.user_help.configurations')
@stop
