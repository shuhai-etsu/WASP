@extends('template.layout_sidebar')

@section('title')
    Home
@endsection

@section('page')
    <form class="form-horizontal">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="semester" class="col-sm-2 col-form-label">Default Page</label>
                <div class="col-sm-4">
                    <div id="default" class="form-control"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-filter" onclick="setDefault()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
