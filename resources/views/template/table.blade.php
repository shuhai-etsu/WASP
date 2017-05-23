<table class="{{$table_classes or 'table table-striped table-bordered custab template-table '}} {{$table_add_css or ''}}">
    <thead>
        @yield('table_headers')
    </thead>
    <tbody>
        @yield('table_rows')
    </tbody>
</table>

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
@endpush


{{--<!-- Sample usage

@section('table_headers')
    <tr>
        <th>Button#1</th>
    </tr>
@stop
@section('table_rows')
    <tr>
        <td>@include('template.table_button', array('button_css_replace_default' => 'btn btn-danger', 'button_link' => '#', 'button_text' => 'Dismiss'))</td>
    </tr>
@stop
@include('template.table')

-->--}}