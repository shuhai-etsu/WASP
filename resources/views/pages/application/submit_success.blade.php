@extends('template.layout_no_sidebar')

@push('css')
    <link href="{{ URL::asset('css/error.css') }}" media="screen" rel="stylesheet" type="text/css">
@endpush

@section('page')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>Yay!</h1>
                    <h2>Application submitted successfully</h2>
                    <div class="error-details">
                        Keep an eye on your email for notices regarding your application's status.
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop