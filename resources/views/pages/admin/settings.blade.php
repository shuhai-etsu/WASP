@extends('template.layout_sidebar')

@section('title')
    User Settings
@endsection

@section('page')
    {{ Form::open(array('id' => 'settings','method'=>'post','onSubmit'=>'return false;', 'class'=>'form-horizontal')) }}
    <div class="form-group">
        <label class="control-label col-sm-2" for="age-group">Notification expires after</label>
        <div class="col-sm-1">
            <input type="text" class="form-control" id="expiration-time">
        </div>
        <div class="col-sm-1">
            <select class="form-control" id="age-group">
                <option selected disabled>Interval</option>
                <option>Hours</option>
                <option>Days</option>
            </select>
        </div>
    </div>

    <div class="form-group padding-top-2">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
        </div>
    </div>
    {{ Form::close() }}


<!--     For tabbed structure

   <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#dashboard">Dashboard</a></li>
            <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
        </ul>

        <div class="tab-content">
            <div id="dashboard" class="tab-pane fade in active">
                <h3 class="inline-block">Dashboard Settings</h3>
                <div class="margin-left-2 list-table padding-top-2">
                    <div class="row custyle">
                        <div class="sortable-container">
                            <h4><span>Available Panels</span></h4>
                            <div id="sortable1" class="sortable"></div>
                        </div>
                        <div class="sortable-container">
                            <h4><span>Panels Displayed</span></h4>
                            <div id="sortable2" class="sortable"></div>
                        </div>
                    </div>
                </div>
                <div style="margin:2%">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
        </div>
    </div> -->
@stop