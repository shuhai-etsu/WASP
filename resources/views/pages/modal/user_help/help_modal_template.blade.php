<!-- modal button
<a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
-->

<!-- modal to be displayed once button is pressed -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="helpModalLabel">@yield('help_modal_title')</h3>
            </div>
            <div class="modal-body">
                @yield('help_modal_body')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>