<div id="main" class="row" style="margin-bottom:200px; margin-left: 0; margin-right: 0">
    <div class = "col-md-3 col-sm-3">
        @include('template.sidebar')
    </div>

    <div class = "col-md-9 col-sm-9" >
        <div>
            @include('template.title')
            <div class="row">
                @yield('page')
            </div>
        </div>
    </div>
</div>