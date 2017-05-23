<!-- modal -->
<div class="modal fade" id="confirmation_modal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="confirmModalLabel">Confirm {{ $action }}</h3>
            </div>

            <div class="modal-body">
                Are you sure you want to {{ $action_description }}?
            </div>
            
            <div class="modal-footer">
                <a href="{{isset($action_route)? $action_route:'#'}}" class="btn btn-danger" data-dismiss="{{isset($action_route)? '':'modal'}}">{{$action}}</a>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>